function status() {
    return {
        init() {
            window.setTimeout(() => this.close(), 5000)
        },
        close() {
            this.$refs.status.remove()
        }
    }
}

export {
    status
}
