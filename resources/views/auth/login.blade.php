<x-layout.guest class="auth">
    <div>
        <x-neon.form>
            @if (session('status'))
                <p class="status">{{ session('status') }}</p>
            @endif
            <x-neon.input.email value="{{ old('email') }}" autofocus required />
            <x-neon.input.password required />
            <footer>
                <button type="submit">Login</button>
                @if (Route::has('password.recovery'))
                    <a class="link" href="{{ route('password.recovery') }}">Forgot your password?</a>
                @endif
            </footer>
        </x-neon.form>
        @if (Route::has('register'))
            <p>
                <a href="{{ route('register') }}">Don&rsquo;t have an account yet?</a>
            </p>
        @endif
    </div>
</x-layout.guest>
