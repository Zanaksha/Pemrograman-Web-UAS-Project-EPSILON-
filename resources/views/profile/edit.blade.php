@extends('layouts.mainlayout')
@section('title', 'Profile')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div style="height: 80px;"></div>

<style>
    .profile-wrap { max-width: 700px; margin: 0 auto; padding: 40px 20px 80px; }
    .profile-header { margin-bottom: 32px; }
    .profile-header h1 { font-size: 28px; font-weight: 700; color: #111; margin-bottom: 6px; }
    .role-badge { display: inline-block; background: #111; color: #fff; font-size: 11px; letter-spacing: 1px; text-transform: uppercase; padding: 4px 12px; border-radius: 20px; margin-bottom: 10px; }
    .avatar-circle {
        width: 72px; height: 72px; border-radius: 50%; background: #0066cc;
        color: #fff; display: flex; align-items: center; justify-content: center;
        font-size: 28px; font-weight: 700; margin-bottom: 16px;
    }
    .profile-card {
        background: #fff; border: 1px solid #eee; border-radius: 14px;
        padding: 28px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0,0,0,.04);
    }
    .profile-card h2 { font-size: 17px; font-weight: 700; color: #111; margin-bottom: 4px; }
    .profile-card .sub { font-size: 13px; color: #888; margin-bottom: 22px; }
    .form-group { margin-bottom: 16px; }
    .form-group label { display:block; font-size: 13px; color: #666; margin-bottom: 6px; }
    .form-group input {
        height: 44px; border: 1.5px solid #ddd; border-radius: 8px;
        padding: 0 14px; font-size: 14px; color: #111; width: 100%;
        outline: none; transition: border-color 0.2s;
    }
    .form-group input:focus { border-color: #0066cc; }
    .btn-save {
        background: #0066cc; color: #fff; border: none; border-radius: 8px;
        padding: 0 26px; height: 42px; font-size: 14px; font-weight: 600; cursor: pointer;
    }
    .btn-save:hover { background: #0055aa; }
    .saved-msg { font-size: 13px; color: #1D9E75; margin-left: 10px; }
    .err-msg { font-size: 12px; color: #cc0000; margin-top: 6px; }
    .danger-zone { border-color: #f5c2c7; }
    .danger-zone h2 { color: #cc0000; }
    .btn-danger-outline {
        background: transparent; color: #cc0000; border: 1.5px solid #cc0000;
        border-radius: 8px; padding: 0 22px; height: 42px; font-size: 14px; cursor: pointer;
    }
    .btn-danger-outline:hover { background: #fdecec; }
    .verify-box { font-size: 13px; color: #555; margin-top: 8px; }
    .verify-box button { color: #0066cc; background: none; border: none; text-decoration: underline; cursor: pointer; padding: 0; font-size: 13px; }
</style>

<div class="profile-wrap">
    <div class="profile-header">
        <div class="avatar-circle">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
        @if (Auth::user()->role === 'admin')
            <span class="role-badge">Administrator</span>
        @endif
        <h1>Profil Saya</h1>
        <p style="color:#888; font-size:14px;">Kelola informasi akun dan keamanan kamu.</p>
    </div>

    {{-- Profile Information --}}
    <div class="profile-card">
        <h2>Informasi Profil</h2>
        <p class="sub">Update nama dan alamat email kamu.</p>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name', 'updateProfileInformation')
                    <p class="err-msg">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email', 'updateProfileInformation')
                    <p class="err-msg">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="verify-box">
                        Email kamu belum diverifikasi.
                        <button form="send-verification" type="submit">Kirim ulang email verifikasi</button>
                        @if (session('status') === 'verification-link-sent')
                            <p style="color:#1D9E75; margin-top:6px;">Link verifikasi baru telah dikirim.</p>
                        @endif
                    </div>
                @endif
            </div>

            <button type="submit" class="btn-save">Simpan</button>
            @if (session('status') === 'profile-updated')
                <span class="saved-msg">Tersimpan.</span>
            @endif
        </form>
    </div>

    {{-- Update Password --}}
    <div class="profile-card">
        <h2>Ubah Password</h2>
        <p class="sub">Pastikan akun kamu menggunakan password yang panjang dan acak agar tetap aman.</p>

        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label>Password Saat Ini</label>
                <input type="password" name="current_password" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <p class="err-msg">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <p class="err-msg">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <p class="err-msg">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-save">Simpan</button>
            @if (session('status') === 'password-updated')
                <span class="saved-msg">Tersimpan.</span>
            @endif
        </form>
    </div>

    {{-- Delete Account --}}
    <div class="profile-card danger-zone">
        <h2>Hapus Akun</h2>
        <p class="sub">Setelah akun dihapus, semua data dan riwayat pesanan akan dihapus permanen. Unduh data yang ingin kamu simpan sebelum melanjutkan.</p>

        <button type="button" class="btn-danger-outline" onclick="document.getElementById('deleteConfirmBox').style.display='block'; this.style.display='none';">
            Hapus Akun
        </button>

        <div id="deleteConfirmBox" style="display:none; margin-top:16px;">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div class="form-group">
                    <label>Masukkan password untuk konfirmasi</label>
                    <input type="password" name="password" placeholder="Password">
                    @error('password', 'userDeletion')
                        <p class="err-msg">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn-danger-outline" style="background:#cc0000; color:#fff; border-color:#cc0000;">
                    Konfirmasi Hapus Akun
                </button>
            </form>
        </div>
    </div>
</div>

@endsection