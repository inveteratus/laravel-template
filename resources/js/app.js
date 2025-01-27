import './bootstrap';
import { Acme } from './acme.js';
import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

Acme.init(Alpine);
Livewire.start();
