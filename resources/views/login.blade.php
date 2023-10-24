@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <!-- Session Status -->
                @if (session('status'))
                    <p class="mb-4">{{ session('status') }}</p>
                @endif

                <!-- Validation Errors -->
                @if ($errors->any())
                    <ul class="mb-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email">Email</label>
                        <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password">Password</label>
                        <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif
                        <button type="submit" class="ml-3">Log in</button>
                    </div>
                </form>
            </div>
    </div>
</div>
@endsection
