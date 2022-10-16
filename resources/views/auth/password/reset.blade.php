<x-layout.guest class="auth">
    <x-neon.form>
        <x-neon.input.email value="{{ old('email', $email) }}" autofocus required />
        <x-neon.input.password required />
        <footer>
            <button type="submit">Reset Password</button>
            <input type="hidden" name="token" value="{{ $token }}">
        </footer>
    </x-neon.form>
</x-layout.guest>
