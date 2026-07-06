<?php

namespace App\Services;

/**
 * TfIdfMatcher
 *
 * Simple TF-IDF + Cosine Similarity matcher untuk mencocokkan pesan user
 * dengan daftar pertanyaan (misal FAQ) tanpa perlu library eksternal.
 *
 * Cara kerja singkat:
 * 1. Setiap pertanyaan FAQ diubah jadi vektor TF-IDF berdasarkan seluruh
 *    korpus (semua pertanyaan FAQ + pesan user dianggap satu "dokumen").
 * 2. Pesan user juga diubah jadi vektor TF-IDF dengan vocabulary yang sama.
 * 3. Similarity antara pesan user dan setiap FAQ dihitung pakai cosine similarity.
 * 4. FAQ dengan similarity tertinggi (di atas threshold) dipilih sebagai jawaban.
 *
 * Kelebihan dibanding str_contains + stopword manual:
 * - Kata yang jarang muncul di korpus (lebih "informatif") diberi bobot lebih tinggi.
 * - Tidak butuh exact substring match, tapi tetap ringan (murni PHP, tanpa ML library).
 * - Bisa dikombinasikan dengan stemming/fuzzy matching untuk hasil lebih baik lagi.
 */
class TfIdfMatcher
{
    /** @var array<int, array<string, int>> term frequency tiap dokumen */
    protected array $termFrequencies = [];

    /** @var array<string, float> inverse document frequency tiap term */
    protected array $idf = [];

    /** @var array<int, mixed> dokumen asli (misal objek Faq) */
    protected array $documents = [];

    /** @var array<string> daftar stopword bahasa Indonesia + Inggris (bisa ditambah) */
    protected array $stopWords = [
        // Indonesian
        'yang', 'untuk', 'dengan', 'dari', 'pada', 'adalah', 'ini', 'itu',
        'dan', 'atau', 'jika', 'apa', 'apakah', 'bagaimana', 'kapan', 'dimana',
        'saya', 'kamu', 'anda', 'akan', 'bisa', 'dapat', 'ada', 'tidak',
        'ya', 'ke', 'di', 'ku', 'mu', 'nya', 'juga', 'saja', 'lah', 'kah',
        // English
        'how', 'can', 'what', 'when', 'where', 'will', 'does', 'have',
        'your', 'with', 'that', 'this', 'from', 'the', 'is', 'are', 'a', 'an',
    ];

    /**
     * Build index dari koleksi dokumen.
     *
     * @param  iterable<mixed>  $documents  koleksi objek/array
     * @param  \Closure  $textExtractor  fungsi untuk ambil teks dari tiap dokumen, misal: fn($faq) => $faq->question
     */
    public function buildIndex(iterable $documents, \Closure $textExtractor): static
    {
        $this->documents = [];
        $this->termFrequencies = [];
        $docFrequency = []; // berapa banyak dokumen yang mengandung term tertentu

        $index = 0;
        foreach ($documents as $doc) {
            $text = $textExtractor($doc);
            $tokens = $this->tokenize($text);

            $tf = array_count_values($tokens);
            $this->termFrequencies[$index] = $tf;
            $this->documents[$index] = $doc;

            foreach (array_keys($tf) as $term) {
                $docFrequency[$term] = ($docFrequency[$term] ?? 0) + 1;
            }

            $index++;
        }

        $totalDocs = max($index, 1);

        // IDF = log(total dokumen / (1 + jumlah dokumen yang mengandung term)) + 1
        // +1 smoothing supaya term yang muncul di semua dokumen tetap punya bobot > 0
        foreach ($docFrequency as $term => $df) {
            $this->idf[$term] = log($totalDocs / (1 + $df)) + 1;
        }

        return $this;
    }

    /**
     * Cari dokumen paling mirip dengan query.
     *
     * @return array{document: mixed, score: float}|null
     */
    public function findBestMatch(string $query, float $threshold = 0.15): ?array
    {
        $queryTokens = $this->tokenize($query);
        if (empty($queryTokens)) {
            return null;
        }

        $queryTf = array_count_values($queryTokens);
        $queryVector = $this->toTfIdfVector($queryTf);

        $bestScore = 0.0;
        $bestIndex = null;

        foreach ($this->termFrequencies as $index => $tf) {
            $docVector = $this->toTfIdfVector($tf);
            $score = $this->cosineSimilarity($queryVector, $docVector);

            if ($score > $bestScore) {
                $bestScore = $score;
                $bestIndex = $index;
            }
        }

        if ($bestIndex === null || $bestScore < $threshold) {
            return null;
        }

        return [
            'document' => $this->documents[$bestIndex],
            'score' => $bestScore,
        ];
    }

    /**
     * Ambil semua match yang melewati threshold, diurutkan dari skor tertinggi.
     * Berguna untuk debugging atau menampilkan beberapa alternatif jawaban.
     *
     * @return array<int, array{document: mixed, score: float}>
     */
    public function findAllMatches(string $query, float $threshold = 0.15): array
    {
        $queryTokens = $this->tokenize($query);
        if (empty($queryTokens)) {
            return [];
        }

        $queryTf = array_count_values($queryTokens);
        $queryVector = $this->toTfIdfVector($queryTf);

        $results = [];
        foreach ($this->termFrequencies as $index => $tf) {
            $docVector = $this->toTfIdfVector($tf);
            $score = $this->cosineSimilarity($queryVector, $docVector);

            if ($score >= $threshold) {
                $results[] = [
                    'document' => $this->documents[$index],
                    'score' => $score,
                ];
            }
        }

        usort($results, fn($a, $b) => $b['score'] <=> $a['score']);

        return $results;
    }

    /**
     * Tokenisasi teks: lowercase, hapus tanda baca, buang stopword & kata pendek.
     *
     * @return array<int, string>
     */
    protected function tokenize(string $text): array
    {
        $text = strtolower($text);
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $text); // buang tanda baca, support unicode
        $words = preg_split('/\s+/', trim($text), -1, PREG_SPLIT_NO_EMPTY);

        return array_values(array_filter($words, function ($word) {
            return mb_strlen($word) > 2 && !in_array($word, $this->stopWords, true);
        }));
    }

    /**
     * Ubah term-frequency map jadi vektor TF-IDF (associative array term => weight).
     *
     * @param  array<string, int>  $tf
     * @return array<string, float>
     */
    protected function toTfIdfVector(array $tf): array
    {
        $vector = [];
        $totalTerms = max(array_sum($tf), 1);

        foreach ($tf as $term => $count) {
            $termFreq = $count / $totalTerms; // normalisasi TF
            $idfWeight = $this->idf[$term] ?? log(count($this->termFrequencies) + 1); // term baru: idf default
            $vector[$term] = $termFreq * $idfWeight;
        }

        return $vector;
    }

    /**
     * Hitung cosine similarity antara dua vektor sparse (associative array).
     */
    protected function cosineSimilarity(array $a, array $b): float
    {
        $dotProduct = 0.0;
        foreach ($a as $term => $weight) {
            if (isset($b[$term])) {
                $dotProduct += $weight * $b[$term];
            }
        }

        $magnitudeA = sqrt(array_sum(array_map(fn($w) => $w * $w, $a)));
        $magnitudeB = sqrt(array_sum(array_map(fn($w) => $w * $w, $b)));

        if ($magnitudeA == 0 || $magnitudeB == 0) {
            return 0.0;
        }

        return $dotProduct / ($magnitudeA * $magnitudeB);
    }
}