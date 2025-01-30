@props(['name', 'label' => null, 'value' => ''])
<x-input :name="$name" :label="$label" component="file">
    <div x-data="fileInput('{{$value}}')">
        <button type="button" :id="$id('input')" @click.prevent.stop="$refs.input.click()">
            <span>Select &hellip;</span>
            <span x-text="filename()" :title="filename()"></span>
            <a href="#" x-cloak x-show="changed()" @click.prevent.stop="reset()" tabindex="-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
                </svg>
            </a>
        </button>
        <input type="file" name="{{ $name }}" class="hidden" x-ref="input" @change="update(Object.values($event.target.files))" {{ $attributes }} />
    </div>
</x-input>
