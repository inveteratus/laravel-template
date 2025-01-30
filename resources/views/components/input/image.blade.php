@props(['name', 'label' => null, 'value' => null])
<x-input :name="$name" :label="$label" component="image">
    <div x-data="imageInput('{{$value}}')">
        <div>
            <img src="{{ $value }}" class="" x-ref="image" x-cloak x-show="hasImage" alt="" />
        </div>
        <input type="file" :id="$id('input')" x-ref="input" name="{{ $name }}" @change="onChange" accept="image/png, image/jpeg">
        <div>
            <button type="button" @click="pick()" x-text="hasImage?'Change&hellip;':'Select&hellip;'"></button>
            @if (!$attributes->has('required'))
                <button type="button" @click="remove()" {{ $attributes }}>Remove</button>
            @endif
        </div>
    </div>
</x-input>
