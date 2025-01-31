import './bootstrap';
import { Acme } from './acme.js';
import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
//import persist from '@alpinejs/persist';

Acme.init(Alpine);
//Alpine.plugin(persist)

Livewire.start();
