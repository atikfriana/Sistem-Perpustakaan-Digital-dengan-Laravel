@extends('layouts.app-center')

@section('content')
<div class="w-full max-w-6xl px-6 md:px-12 flex flex-col md:flex-row items-center justify-between min-h-screen mx-auto">
    <!-- Form Section -->
    <div class="w-full md:w-1/2 max-w-md">
        <div class="mb-16">
            <button aria-label="Kembali" class="text-black text-2xl" onclick="history.back()">
                <i class="fas fa-arrow-left"></i>
            </button>
        </div>

        <h1 class="font-extrabold text-xl mb-8">Masuk</h1>

        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
            @csrf

            <div class="flex flex-col">
                <label class="sr-only" for="email">Email</label>
                <input id="email" name="email" type="email"
                       placeholder="Email"
                       class="border-b border-gray-300 focus:outline-none focus:border-blue-500 text-base pb-2"
                       required autofocus value="{{ old('email') }}">
                @error('email')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col relative">
                <label class="sr-only" for="password">Kata Sandi</label>
                <input id="password" name="password" type="password"
                       placeholder="Kata Sandi"
                       class="border-b border-gray-300 focus:outline-none focus:border-blue-500 text-base pb-2 pr-8"
                       required>
                <button type="button" aria-label="Toggle password visibility"
                        onclick="togglePassword()"
                        class="absolute right-0 bottom-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-eye-slash" id="toggleIcon"></i>
                </button>
                @error('password')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" name="remember" class="form-checkbox rounded text-blue-600"
                           {{ old('remember') ? 'checked' : '' }}>
                    Ingat Saya
                </label>
            </div>

            @if (Route::has('password.request'))
            <a class="text-blue-600 text-sm" href="{{ route('password.request') }}">
                Lupa kata sandi?
            </a>
            @endif

            <button type="submit" class="bg-blue-500 text-white font-extrabold text-lg rounded px-4 py-2 mt-8 w-full">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm mt-12">
            Baru di Perpustakaan Digital?
            <a class="text-blue-600" href="{{ route('register') }}">Daftar</a>
        </p>
        <p class="text-center text-sm mt-6 max-w-xs mx-auto">
            Dengan melanjutkan, Anda menyetujui
            <a class="text-blue-600" href="#">Syarat dan Ketentuan</a>
            dan juga
            <a class="text-blue-600" href="#">Kebijakan Privasi</a>
        </p>
    </div>

    <!-- Image Section -->
    <div class="w-full max-w-lg flex justify-center">
        <img alt="Ilustrasi orang membaca" class="max-w-full h-auto"
             src="https://storage.googleapis.com/a1aa/image/5be6a061-bc13-4bb1-ce3d-b9aacaba1776.jpg" />
    </div>
</div>

<script>
function togglePassword() {
    const field = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
}
</script>
@endsection
