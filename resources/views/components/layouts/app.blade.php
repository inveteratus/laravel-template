<x-html class="app">
    <header>
        <nav>
            @auth
                <div>
                    <h1><a href="{{ route('home') }}">{{ config('app.name') }}</a></h1>
                </div>
                <div>
                    <x-theme-selector />
                    <x-user-menu />
                </div>
            @else
                <div>
                    <h1><a href="{{ route('index') }}">{{ config('app.name') }}</a></h1>
                </div>
                <div>
                    <x-theme-selector />
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                </div>
            @endif
        </nav>
    </header>
    {{ $slot }}
    <x-status />
</x-html>
