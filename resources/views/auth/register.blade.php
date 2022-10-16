<x-layout.guest class="auth">
    <div>
        <x-neon.form>
            <x-neon.input.text name="name" value="{{ old('name') }}" autofocus required />
            <x-neon.input.email value="{{ old('email') }}" required />
            <x-neon.input.password required />
            <footer>
                <button type="submit">Register</button>
            </footer>
        </x-neon.form>
        @if (Route::has('login'))
            <p>
                <a href="{{ route('login') }}">Already have an account?</a>
            </p>
        @endif
    </div>
</x-layout.guest>
