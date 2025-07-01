@extends('layouts.app-center')

@section('content')
<div class="w-full max-w-6xl px-6 md:px-12 flex flex-col md:flex-row items-center justify-between min-h-screen mx-auto">
    <!-- Form Section -->
    <div class="w-full md:w-1/2 max-w-md">
        <div class="mb-16">
            <button aria-label="Kembali" class="text-black text-xl" onclick="history.back()">
                <i class="fas fa-arrow-left"></i>
            </button>
        </div>

        <h1 class="font-extrabold text-2xl mb-6">Lupa Kata Sandi</h1>
        <p class="text-sm text-gray-600 mb-10">Masukkan email untuk menerima tautan reset kata sandi.</p>

        @if (session('status'))
            <div class="mb-6 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
            @csrf

            <div class="flex flex-col">
                <label for="email" class="sr-only">Email</label>
                <input id="email" type="email"
                       class="border-b border-gray-300 text-base py-2 focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror"
                       name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="bg-blue-500 text-white font-bold text-lg py-2 rounded-md w-full hover:bg-blue-600 transition">
                Kirim Tautan Reset
            </button>
        </form>
    </div>

    <!-- Image Section -->
    <div class="w-full max-w-lg flex justify-center">
        <img alt="Reset Password Illustration" class="max-w-full h-auto"
             src="https://storage.googleapis.com/a1aa/image/5be6a061-bc13-4bb1-ce3d-b9aacaba1776.jpg" />
    </div>
</div>
@endsection
