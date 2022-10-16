@props([
    'label' => null,
    'id' => null,
    'name' => 'password',
])

<div class="field password" x-data="{visible:false}">
    <label for="{{ $id ?? $name }}">{{ $label ?? str($name)->title }}</label>
    <div class="element">
        <div class="control">
            <input id="{{ $id ?? $name }}" :type="visible?'text':'password'" name="{{ $name }}" x-ref="input" {{ $attributes }}>
            <button type="button" @click.prevent.stop="visible=!visible;$refs.input.select();$refs.input.focus()">
                <x-neon.icons.eye x-cloak x-show="visible" />
                <x-neon.icons.eye-slash x-cloak x-show="!visible" />
            </button>
        </div>
        @error($name)
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
</div>
