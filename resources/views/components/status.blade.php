@session('status')
    <div class="acme-component-status" x-ref="status" x-data="status()">
        <p>{{ $value }}</p>
        <button type="button"@click="close()">
            <x-heroicon-o-x-mark />
        </button>
    </div>
@endsession
