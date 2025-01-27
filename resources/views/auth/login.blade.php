<x-layouts.app>
    <main class="auth-login">
        <x-form>
            <x-input.email :value="old('email')" autocomplete="email" required autofocus />
            <x-input.password autocomplete="current-password" required />
            <footer>
                <x-button.submit label="Login" />
                <a href="{{ route('forgot-password') }}">Forgot your password ?</a>
            </footer>
        </x-form>
        <p>
            <a href="{{ route('register') }}">Not got an account yet ?</a>
        </p>
    </main>
</x-layouts.app>
