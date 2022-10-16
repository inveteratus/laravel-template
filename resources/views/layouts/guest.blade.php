<x-neon.html class="guest">

    <header class="navbar">
        <nav>
            <section>
                <a href="{{ route('index') }}">{{ config('app.name') }}</a>
            </section>
            <section>
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endif
            </section>
        </nav>
    </header>

    <main {{ $attributes }}>
        {{ $slot }}
    </main>

    <footer>
        <p>Copyright &copy; {{ now()->format('Y') }} Inveteratus</p>
    </footer>

</x-neon.html>
