require('./bootstrap');

try {
    window.coreui = require('@coreui/coreui');
    require('./components/modal');
    require('./components/sidebar');
} catch (e) {}

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();
