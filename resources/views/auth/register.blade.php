<x-layouts.app>
    <main class="auth-register">
        <x-form>
            <x-input.text name="name" :value="old('name')" autocomplete="name" required autofocus />
            <x-input.email :value="old('email')" autocomplete="email" required />
            <x-input.password autocomplete="current-password" required />
            <footer>
                <x-button.submit label="Register" />
            </footer>
        </x-form>
        <p>
            <a href="{{ route('login') }}">Already got an account ?</a>
        </p>
    </main>
</x-layouts.app>
