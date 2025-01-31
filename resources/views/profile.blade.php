<x-layouts.app>
    <main class="profile" x-data="{tab:$persist(0).as('profile_page')}">
        <div>
            <button type="button" @click="tab=0">
                <x-heroicon-o-user />
                <span>User Profile</span>
            </button>

            <button type="button" @click="tab=1">
                <x-heroicon-o-key />
                <span>Change Password</span>
            </button>

            <button type="button" @click="tab=2">
                <x-heroicon-o-envelope />
                <span>Verify Email</span>
            </button>

            <button type="button" @click="tab=3">
                <x-heroicon-o-trash />
                <span>Delete Account</span>
            </button>
        </div>

        <div>
            <x-form :action="route('profile.update-profile')" x-cloak x-show="tab==0" enctype="multipart/form-data">
                <h2>User Profile</h2>

                <x-input.text name="name" :value="old('name',auth()->user()->name)" autocomplete="name" required autofocus />
                <x-input.email name="email" :value="old('email',auth()->user()->email)" autocomplete="email" required />
                <x-input.image name="image" value="{{ auth()->user()->profile_image ? Storage::url(auth()->user()->profile_image) : '' }}" />

                <footer>
                    <x-button.submit label="Save" />
                </footer>
            </x-form>

            <x-form :action="route('profile.change-password')" x-cloak x-show="tab==1">
                <h2>Change Password</h2>

                <x-input.password name="current" label="Current Password" autocomplete="current-password" required />
                <x-input.password name="password" label="New Password" autocomplete="new-password" required />

                <footer>
                    <x-button.submit label="Save" />
                </footer>
            </x-form>

            <x-form :action="route('profile.verify-email')" method="post" x-cloak x-show="tab==2">
                <h2>Verify Email</h2>

                <p>Ensure your email address is up-to-date by sending a confirmation email.</p>

                <footer>
                    <x-button.submit label="Send" />
                </footer>
            </x-form>

            <x-form :action="route('profile.delete-account')" method="delete" x-cloak x-show="tab==3">
                <h2>Delete Account</h2>

                <p>Before deleting your account, please download any data or information that you wish to retain.</p>

                <footer>
                    <x-button.submit label="Delete Account" class="danger" />
                </footer>
            </x-form>
        </div>
    </main>
</x-layouts.app>
