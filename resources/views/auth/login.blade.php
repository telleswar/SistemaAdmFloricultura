@extends('layouts.base')

@section('content')
<div id="tela-login" class="flex items-center justify-center h-700 ">
    <div class="w-full max-w-md p-6 bg-pink-300 rounded-lg shadow-md">
        <div class="text-2xl font-semibold mb-6">{{ __('Login') }}</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="col-form-label block text-white">{{ __('Email') }}</label>
                <input id="email" type="email" class="form-control form-input mt-1 block w-full @error('email') border-red-500 @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-white">{{ __('Senha') }}</label>
                <input id="password" type="password"
                    class="form-control form-input mt-1 block w-full @error('password') border-red-500 @enderror" name="password"
                    required autocomplete="current-password">

                @error('password')
                    <span class="text-red-500 text-sm mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input class="form-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span class="ml-2">{{ __('Lembre-me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-green-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded">
                    {{ __('Login') }}
                </button>
                <a class="text-pink-500 hover:text-pink-600" href="{{ Route('register') }}">Criar uma conta...</a>
            </div>
        </form>
    </div>
</div>

@endsection
