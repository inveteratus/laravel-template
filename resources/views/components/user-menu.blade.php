<div x-data="{open:false}" class="acme-user-menu">
    @if (auth()->user()->profile_image)
        <button type="button" @click="open=!open" class="image">
            <img src="{{ Storage::url(auth()->user()->profile_image) }}" alt="" />
        </button>
    @else
        <button type="button" @click="open=!open" class="text">
            <span>{{ auth()->user()->name }}</span>
            <x-heroicon-m-chevron-down />
        </button>
    @endif
    <div x-cloak x-show="open" @click.away="open=false">
        <a href="{{ route('profile.index') }}">
            <x-heroicon-o-user />
            <span>Profile &hellip;</span>
        </a>
        {{ $slot }}
        <hr />
        <x-form :action="route('logout')">
            <button type="submit">
                <x-heroicon-o-power />
                <span>Logout</span>
            </button>
        </x-form>
    </div>
</div>
