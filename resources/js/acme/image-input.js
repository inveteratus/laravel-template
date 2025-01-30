function imageInput(value = null) {
    return {
        hasImage: false,
        _files: null,
        _saved: null,

        init() {
            if (value) {
                this._files = [{name: value}]
                this.hasImage = true
            } else {
                this._files = []
            }

            this._saved = this._files
        },

        pick() {
            this.$refs.input.click()
        },
        remove() {
            if (this.hasImage) {
                this.hasImage = false
                this._files = [];
                this.$refs.input.value = null
            }
        },
        onChange() {
            let file = this.$refs.input.files[0];
            if (!file || file.type.indexOf('image/') === -1) {
                return
            }
            let reader = new FileReader();
            reader.onload = e => {
                this.$refs.image.src = e.target.result
            }
            reader.readAsDataURL(file)
            this.hasImage = true
        }
    }
}

export {
    imageInput
}
