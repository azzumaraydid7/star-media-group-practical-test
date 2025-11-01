@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container py-40">
        <div class="bg-white shadow-md rounded-lg p-8 mx-auto w-full max-w-sm">
            <h2 class="text-2xl font-bold mb-4 text-center">Admin Login</h2>

            @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm mb-1">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required value="{{ old('email') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-sm mb-1">Password</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200" required value="{{ old('password') }}">
                    <div class="text-sm text-right text-blue-600 cursor-pointer" onclick="togglePasswordVisibility('password')">
                        Show Password
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                    Login
                </button>
            </form>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(fieldName) {
            const passwordField = document.getElementsByName(fieldName)[0];
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        }
    </script>
@endsection
