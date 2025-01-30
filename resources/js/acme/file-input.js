function fileInput(value = null) {
    return {
        _files: null,
        _saved: null,

        init() {
            if (value) {
                this._files = [{name: value}]
            } else {
                this._files = []
            }

            this._saved = this._files
        },

        filename() {
            return this._files.length ? this._files[0].name : '';
        },

        changed() {
            return this._files !== this._saved
        },

        update(files) {
            this._files = files
        },

        reset() {
            this._files = this._saved
        }
    }
}

export {
    fileInput
}
