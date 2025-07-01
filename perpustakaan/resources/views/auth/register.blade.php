@extends('layouts.app-center')

@section('content')
<div class="w-full max-w-6xl px-6 md:px-12 flex flex-col md:flex-row items-center justify-between min-h-screen mx-auto">
    <!-- Form Section -->
    <div class="w-full md:w-1/2 max-w-md">
        <div class="mb-16">
            <button aria-label="Back" onclick="history.back()" class="text-black text-xl">
                <i class="fas fa-arrow-left"></i>
            </button>
        </div>

        <h2 class="font-bold text-2xl mb-10">Buat Akun</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-8">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="sr-only">Nama</label>
                <input id="name" type="text"
                       class="w-full border-b border-gray-300 text-lg py-2 focus:outline-none focus:border-black @error('name') border-red-500 @enderror"
                       name="name" placeholder="Nama"
                       value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="sr-only">Email</label>
                <input id="email" type="email"
                       class="w-full border-b border-gray-300 text-lg py-2 focus:outline-none focus:border-black @error('email') border-red-500 @enderror"
                       name="email" placeholder="Email"
                       value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="relative">
                <label for="password" class="sr-only">Kata Sandi</label>
                <input id="password" type="password"
                       class="w-full border-b border-gray-300 text-lg py-2 pr-10 focus:outline-none focus:border-black @error('password') border-red-500 @enderror"
                       name="password" placeholder="Kata Sandi"
                       required autocomplete="new-password">

                <button type="button" class="absolute right-0 top-1/2 -translate-y-1/2 pr-3 text-gray-500" onclick="togglePassword('password', 'toggleIcon1')" aria-label="Toggle password visibility">
                    <i class="fas fa-eye-slash" id="toggleIcon1"></i>
                </button>

                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="relative">
                <label for="password-confirm" class="sr-only">Konfirmasi Kata Sandi</label>
                <input id="password-confirm" type="password"
                       class="w-full border-b border-gray-300 text-lg py-2 pr-10 focus:outline-none focus:border-black"
                       name="password_confirmation" placeholder="Konfirmasi Kata Sandi"
                       required autocomplete="new-password">

                <button type="button" class="absolute right-0 top-1/2 -translate-y-1/2 pr-3 text-gray-500" onclick="togglePassword('password-confirm', 'toggleIcon2')" aria-label="Toggle password confirmation visibility">
                    <i class="fas fa-eye-slash" id="toggleIcon2"></i>
                </button>
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="w-full bg-blue-500 text-white font-bold text-lg py-2 rounded-md hover:bg-blue-600 transition">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center mt-16 text-sm text-black">
            Sudah Punya Akun?
            @if (Route::has('login'))
                <a class="text-blue-600" href="{{ route('login') }}">Masuk</a>
            @else
                <a class="text-blue-600" href="#">Masuk</a>
            @endif
        </p>
    </div>

    <!-- Image Section -->
    <div class="w-full max-w-lg flex justify-center">
      <img alt="Ilustrasi orang membaca" class="max-w-full h-auto"
           src="https://storage.googleapis.com/a1aa/image/5be6a061-bc13-4bb1-ce3d-b9aacaba1776.jpg" />
    </div>
</div>

<script>
function togglePassword(fieldId, iconId) {
    const passwordField = document.getElementById(fieldId);
    const icon = document.getElementById(iconId);

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}
</script>
@endsection
