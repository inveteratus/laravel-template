import { themeSelector } from './acme/theme-selector.js';

class Acme {
    static init(alpine) {
        alpine.data('themeSelector', themeSelector)
    }
}

export {
    Acme
}
