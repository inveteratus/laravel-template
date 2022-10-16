<x-layout.guest class="auth">
    <div>
        <x-neon.form>
            @if (session('status'))
                <p class="status">{{ session('status') }}</p>
            @endif
            <p>Enter your email address, and we&rsquo;ll send out a password reset link.</p>
            <x-neon.input.email value="{{ old('email') }}" autofocus required />
            <footer>
                <div>
                    <button type="submit">Register</button>
                    <a href="{{ route('login') }}" class="cancel">Cancel</a>
                </div>
            </footer>
        </x-neon.form>
    </div>
</x-layout.guest>
