require('./bootstrap');

try {
    require('bootstrap');
} catch (e) {}

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();
