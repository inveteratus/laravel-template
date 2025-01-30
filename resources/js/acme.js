import { themeSelector } from './acme/theme-selector.js';
import { fileInput } from './acme/file-input.js';
import { imageInput } from './acme/image-input.js';
import { status } from './acme/status.js';

class Acme {
    static init(alpine) {
        alpine.data('themeSelector', themeSelector)
        alpine.data('fileInput', fileInput)
        alpine.data('imageInput', imageInput)
        alpine.data('status', status)
    }
}

export {
    Acme
}
