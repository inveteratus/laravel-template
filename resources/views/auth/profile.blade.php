<x-layouts.app>
    <main class="profile">
        <x-form :action="route('update-profile')">
            <div>
                <div>
                    <h2>Basic Information</h2>
                    <p>Update your account's profile information and email address.</p>
                </div>
                <x-input.text name="name" :value="old('name',auth()->user()->name)" autocomplete="name" required autofocus />
                <x-input.email name="email" :value="old('email',auth()->user()->email)" autocomplete="email" required />
            </div>
            <footer>
                <x-button.submit label="Update" />
            </footer>
        </x-form>
        @if (!auth()->user()->hasVerifiedEmail())
            <x-form :action="route('verify-email')">
                <div>
                    <div>
                        <h2>Verify Email</h2>
                        <p>Click here to re-send the verification email so you can recover your password.</p>
                    </div>
                </div>
                <footer>
                    <x-button.submit label="Send Verification Mail" />
                </footer>
            </x-form>
        @endif
        <x-form :action="route('change-password')">
            <div>
                <div>
                    <h2>Change Password</h2>
                    <p>Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <x-input.password name="current" label="Current Password" autocomplete="current-password" required />
                <x-input.password name="password" label="New Password" autocomplete="new-password" required />
            </div>
            <footer>
                <x-button.submit label="Update" />
            </footer>
        </x-form>
        <x-form :action="route('delete-account')" method="delete">
            <div>
                <div>
                    <h2>Delete Account</h2>
                    <p>Before deleting your account, please download any data or information that you wish to retain.</p>
                </div>
                <x-input.password name="password" autocomplete="current-password" required />
            </div>
            <footer>
                <x-button.submit label="Delete Account" class="danger" />
            </footer>
        </x-form>
    </main>
</x-layouts.app>
