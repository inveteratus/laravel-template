<x-neon.html class="app">
    <header class="navbar">
        <nav x-data="{user_menu_open:false}">
            <section>
                <a href="{{ route('home') }}">{{ config('app.name') }}</a>
            </section>
            <section>
                <div>
                    <button type="button" @click="user_menu_open=!user_menu_open">
                        <img src="https://www.gravatar.com/avatar/{{ md5(str(Auth::user()->email)->lower()) }}?s=100" alt="" />
                    </button>
                    <x-neon.form action="{{ route('logout') }}" x-cloak x-show="user_menu_open" @click.away.prevent.stop="user_menu_open=false">
                        <a href="#">Link</a>
                        <a href="#">Long Link</a>
                        <a href="#">Very Long Link</a>
                        <hr>
                        @if (config('telescope.enabled') && Route::has('telescope') && Auth::user()->superuser)
                            <a href="{{ route('telescope') }} " target="{{ str(config('app.name') . ' Telescope')->slug() }}">Telescope</a>
                            <hr>
                        @endif
                        <button>Logout</button>
                    </x-neon.form>
                </div>
            </section>
        </nav>
    </header>
    <main {{ $attributes }}>
        {{ $slot }}
    </main>
</x-neon.html>
