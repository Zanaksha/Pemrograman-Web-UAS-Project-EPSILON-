<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        $cars = [
            [
                'name'       => 'iX',
                'slug'       => 'ix',
                'category'   => 'SUV',
                'series'     => 'X',
                'drivetrain' => '100% Electric',
                'image'      => 'https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-7331pKAuhFqIbVBIHS91Zys8%25P6EaURyfNwOTjHADv6Ojd%25p12aKkiH0scCuHVsaAb0%25lR2oubWTkFKqvLB9oeWF5Ga2ysId4e%257SxfBzAF3aJQbAFKdqf62lKwLVM%258w0KETayVqTbhBHHS9WZFSrCWcFtTjO3GgiTQdjcjTW3azDx4o1dnkq8cF4zOALUxKPkIFJG8WkABKupC9PFeWS6ldbKMPVYXzsWhbNmQFnPo90yW7NbHi4TPYR9%25wc3bKHiftxd9WDw178ziZqtECUkw5z7slGAtadCrXpF7sDlZQ6KCrrXRaYWlH8Q5nmPX%25QagOybQB7nvIT9FoZO2B3iKHvIjedwWChBDMztPuzeqhk7bSEMLoAC9VLhJHFlievou%25KXwD6HSfWQrgu%25V1PaZcMfNEbnRx310s9O5z6E4riIgkAscZwBvg7rxRte2yzZ857MjgRRUgChDS35Gvlovsggp2XH2yyv6jQ%25j1t2YDafD6xjmBjVwsoH0%25l05zxO4WsyZOvdImvhjVB5xbZP%25F6Y8snGXMESk%25CaDi2aKSAmxscCEI5s%25rt3Xe',
            ],
            [
                'name'       => 'iX1',
                'slug'       => 'ix1',
                'category'   => 'SUV',
                'series'     => 'X',
                'drivetrain' => '100% Electric',
                'image'      => 'https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73315jAvmZ7dgM0dpRUQoFSr9VJdoMXOBeypTjHPDDiUi5Bo0aVo7UwFyjmBjVwsoH0%25l0YxxO4WsKmUGpc1QuHAp3ERtXD3gpn0WNR10m7illZyCFnlwXYu3WptvRdrt3LRQrDHW0%25IA2HSfWQWly%25V1PaXGmfNEbnQrX10s9OaZ9E4riInRdscZwBO5xrxRteJOGZ857Mu1vRUgChSU75GvloVm3gp2XHNaMv6jQ%25gJq2YDafvR6jmqn12mUDyLOEjy5qTJIsDRXL3uBrq76JdSeZLU2uzVMRJf0SkNh5ucQVA0ogSkwNF4HvVmP0Kc%252Nye4Wxfj0UucP81D5PAxbUEqgmP89GsLvS6UiprJ2CrGw6ZujlaptYRSDUW67m5VdH9YCygNzaUmlTv0knfyX324AETTQdjcFAq3azDxKiodnkq8h4CzOALUoZkkIFJGH85ABKupK3FFeWS6WBQKMPVYoedWhbNmHMiPox9syh3b4gZqmazOSCmXz4RjayVFbYCja1%25P4fFSr9VSxbZG7NgXA2Jf3KuvQnOlZyrU1OIXYuaq4y9%25UnpqyBLayV3WJY',
            ],
            [
                'name'       => 'i7',
                'slug'       => 'i7',
                'category'   => 'Sedan',
                'series'     => '7',
                'drivetrain' => '100% Electric',
                'image'      => 'https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73315jAvmZ7dgMyDkRUQoFSr9VJdoMXOBeypTjH1sD3Ui5Bo0aVo7UwFyjmBjVwsoH0%25l0gfHR4WsKmUGpc1QuHAp3ERtXD3gpn0WNR10m7illZyCFnlwXYu3WptvRdrt3LRQrDHW0%25IA2HSfWQWcm%25V1PaXlsfNEbnQpy10s9OaZQE4riInRiscZwBO5MrxRteIgrZ857MBvuRUgChSD25GvloVeYgp2XHNrDv6jQ%250Zk2YDaf4iujmqn1cvfDyLOEx2UqTJIsDNOL3uBrq1kJdSeZLjbuzVMRJDdSkNh5ukxVA0ogSjwNF4HvVDd0Kc%252Nd44Wxfj0zacP81D4wGxbUEqc7F89GsLxCUUiprJ8lLGw6ZuU2eptYRSGTL67m5VptIYCygN67QmlTv0YCgyX324mllTQdjcy9O3azDxTi5dnkq83wdzOALUdKmkIFJG49OABKupcmPFeWS6xHSKMPVY8%257WhbNmUfhPo90yGKDbHi4TpeZ9%25wc3lsKiftxdXrLw178zQuvtECUkaSV7slGAngbCrXpFOvWlZQ6KI2lXRaYWBIyQ5nmPeJNagOybMfunvIT9h1yO2B3iuzvIjedwS73BDMztMaeeqhk7hSSMLoACoq4hJHFlHLgou%25KXVMKHSfWQqSr%25Vi18aSOfbYGdQ2BDFRQgBbpT2aKhfXRT2c0%25b4hFU1KFifG7ZWYgMyk4OoAmvjD5GaUtcDqgXA2dba10tjCdaLz2aKOHkX',
            ],
            [
                'name'       => 'i5',
                'slug'       => 'i5',
                'category'   => 'Touring',
                'series'     => '5',
                'drivetrain' => '100% Electric',
                'image'      => '/images/i5thumb.png',
            ],
            [
                'name'       => 'i4',
                'slug'       => 'i4',
                'category'   => 'SUV',
                'series'     => '4',
                'drivetrain' => '100% Electric',
                'image'      => 'https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73315jAvmZ7dgM0dpRUQoFSr9VJdoMXOBeypTjHPs7MUi5Bo0aVo7UwFyjmBjVwsoH0%25l0CzrH4WsKmUGpc1QuHAp3ERtXD3gpn0WNR10m7illZyCFnlwXYu3WptvRdrt3LRQrDHW0%25IA2HSfWQlO%25%25V1PaXGmfNEbnQrX10s9ODQxE4riIqHRscZwBLGxrxRteJ68Z857MulIRUgChZE85GvloRG4gp2XH5psv6jQ%25gFx2YDafvKAjmqn12WGDyLOEjztqTJIsDFiL3uBrqUQJdSeZLGJuzVMRJ0jSkNh5EkTVA0ogsU3NF4HvrbH0Kc%252Z9E4WxfjRiWcP81D5w4xbUEqg4O89GsLvcAUiprJyVWGw6ZuTkiptYRS3XR67m5VdQ8YCygNzaHmlTv0knXyX324AO1TQdjcFs73azDxKrZdnkq8WTdzOALUPWukIFJGb7fABNK%25pIYFSr1vGCyXqiGtySE5CpLdFUi5CoMAShdqfKLqNF1c9Jrt3RjhYzDZ7lXw1pf4oXQtUDCvSpKM4lxvpa2CpLYkjU',
            ],
            [
                'name'       => 'XM',
                'slug'       => 'xm',
                'category'   => 'SUV',
                'series'     => 'X',
                'drivetrain' => 'Plug-in Hybrid',
                'image'      => '/images/xm1.png',
            ],
            [
                'name'       => 'X5',
                'slug'       => 'x5',
                'category'   => 'SUV',
                'series'     => 'X',
                'drivetrain' => 'Plug-in Hybrid',
                'image'      => 'https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-73317K9wt0u4fXBI1EL3hTxVN0JeivOm0GM%25K9ZG10tfnZ1oEiyCIbH8wlD7Z9cvt3OleifGruLBkJnTNM3TFe0SwJeiUS%25JxvQy2sC4v6jQ%25Q9Z2YDafai2jmqn1nvHDyLOEOK%25qTJIs1fSL3uBrE5TJdSeZs05uzVMRr97SkNh5ZzrVA0ogRcZNF4Hv5xj0Kc%252yG84WxfjTSUcP81D3VlxbUEqdNP89GsLz9EUiprJkCQGw6ZuA8JptYRSFUW67m5VKuIYCygNW2umlTv0YkgyX324mVvTQdjcyNX3azDxTYodnkq83mazOALUdbskIFJGzYfABKupkmhFeWS6AHbKMPVYFf7WhbNmK8gPo90yWU6bHi4TP7y9%25wc3bCBiftxd9Iww178ziBwtECUkyn17slGAT5GCrXpF3gBlZQ6KdvZXRaYWzC4Q5nmPeSUagOybMDCnvIT9hqxO2B3io3cIjedwHGNBDMzt%25p6eqhk7fVaMLoAC1fKhJHFlExpou%25KXsg8HSfWQxCD%25V1Pa8lffNEbnU3c10s9OsoEE4riIruoscZwBZRmrxRteRcSZ857M5xSRUQvmEO30BHtuc%25IdkATQLi19mUiOgZ22YI2SiEhoNHCNen060KEQIJ7qIb0W3GRUQunKeNWJeihsPIgpnG7xqLvQFjz9nE47rpI0eswTYAOqhJPX65e3gZ8XVf0ZOKic1QgD',
            ],
            [
                'name'       => 'X3',
                'slug'       => 'x3',
                'category'   => 'SUV',
                'series'     => 'X',
                'drivetrain' => 'Plug-in Hybrid',
                'image'      => 'https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-7331pKAuhFqIbVBIHS9amvhz25GaNKVZfNYt9CCrmu09DP05CZHOdnuiVrc7Z9cv8yR0kIVKoT4fXx6qtaYc1sr%25ViPRKVZlPxK73DIdpvw3azDxDrYdnkq8qZdzOALUL3ckIFJG8xWABKupU31FeWS6GERKMPVYpezWhbNm6ipPo90yYw0bHi4TmtX9%25wc3OK7iftxdIWUw178zB1xtECUkeiV7slGAMytCrXpFhY9lZQ6KomkXRaYWlBOQ5nmPXFYagOybQC5nvIT9av8O2B3in76IjedwOEXBDMztIS1eqhk7BZeMLoAC9L2hJHFlisLou%25KXwn1HSfWQt4S%25V1Pa7o3fNEbnR2V10s9O58oE4riIg5tscZwBvmdrxRte25ZZ857MjuTRUgChyB05GvloTWggp2XH3h0v6jQ%25jZ22YDafD8Zjmqn1qddDyLOELA1qTJIsJyGL3uBruTWJdSeZS3puzVMRAdjSkNh5Fz4VA0ogKklNF1TLdNZnMkJEcGqTMDESqvLB9orO2keH8hSId4Mw54LBDFjTgH%25ekxh06FXRTZhOIBQmSwpsB%25yzDuP%25ABNK%25pIYFSr1vGCyXqjs5v279CpL96aDPoxPCD3p6XYuXhwQy',
            ],
            [
                'name'       => '7',
                'slug'       => '7-series',
                'category'   => 'Sedan',
                'series'     => '7',
                'drivetrain' => 'Petrol',
                'image'      => 'https://prod.cosy.bmw.cloud/bmwweb/cosySec?COSY-EU-100-7331pKAuhFqIbVBIHS9amvhz25GaNKVZfNYt9CCrmu09DP05CZHOdnuiVrc7Z9cv8yR0kIVKoT4fXx6qtaYc1sr%25ViPRKVZlPxK73DIdpvw3azDxDr3dnkq8qMgzOALUx%25skIFJG8OxABKupUP8FeWS6GbSKMPVYp9yWhbNmQtiPo90ya6fbHi4TnFt9%25wc3OK5iftxdIfcw178zBartECUkeSa7slGAMwkCrXpFhtHlZQ6KomiXRaYWlB6Q5nmPXF2agOybQCunvIT9algO2B3in7VIjedwOC5BDMztI5eeqhk7BgUMLoACeV%25hJHFlM0jou%25KXh4HHSfWQocX%25V1PaHtmfNEbn%25Vc10s9OfNNE4riI1qEscZwBQ24rxRteaogZ857Mn67RUgChOYU5GvloIZ0gp2XHLb9v6jQ%25J312YDafuJOjmqn1ScFDyLOEVxnqTJIsFfpL3uBrK5YJdSeZWCAuzVMRPoeSkNh5FzDVA0ogKkcNF1TLdNZnMkJEcGqTMDESqvLB9orO2keH8hSId4Mw54LBDFjTgH%25ekxh06FXRTZhOIBQmSwpsB%25yzDuP%25ABNK%25pIYFSr1vGCyXqd5fYA52QBzc6tif5EqOVAfHnehodmzL1HJJN6726z%250LJAusAUfIN',
            ],
            [
                'name'       => 'M4',
                'slug'       => 'm4',
                'category'   => 'Coupe',
                'series'     => '4',
                'drivetrain' => 'Petrol',
                'image'      => '/images/m4white1.png',
            ],
            [
                'name'       => '4',
                'slug'       => '4-gran-coupe',
                'category'   => 'Coupe',
                'series'     => '4',
                'drivetrain' => 'Petrol',
                'image'      => '/images/4white1.png',
            ],
            [
                'name'       => '4 Convertible',
                'slug'       => '4-convertible',
                'category'   => 'Convertible',
                'series'     => '4',
                'drivetrain' => 'Petrol',
                'image'      => '/images/4whiteup1.png',
            ],
            [
                'name'       => '3',
                'slug'       => '3-series',
                'category'   => 'Sedan',
                'series'     => '3',
                'drivetrain' => 'Petrol',
                'image'      => '/images/3white1.png',
            ],
            [
                'name'       => 'M3',
                'slug'       => 'm3',
                'category'   => 'Sedan',
                'series'     => '3',
                'drivetrain' => 'Petrol',
                'image'      => '/images/m3green1.png',
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}