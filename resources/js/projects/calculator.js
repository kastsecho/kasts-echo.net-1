import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('calc', () => ({
        length: 1,
        width: 1,
        cost: 0.0175,

        get costPerInch() {
            return this.formatCost(this.cost);
        },

        get estimate() {
            return this.formatCost(this.length * this.width * this.cost, 2);
        },

        formatCost(value, digits = 4) {
            return new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: digits,
            }).format(value);
        }
    }))
});

Alpine.start();
