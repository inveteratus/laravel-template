@props([
    'label' => null,
    'id' => null,
    'name' => 'email',
])

<div class="field">
    <label for="{{ $id ?? $name }}">{{ $label ?? str($name)->title }}</label>
    <div class="element">
        <div class="control">
            <input id="{{ $id ?? $name }}" type="email" name="{{ $name }}" {{ $attributes }}>
        </div>
        @error($name)
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
</div>
