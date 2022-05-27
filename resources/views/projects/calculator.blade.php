<div id="calc" v-cloak>
    <div>
        <label for="length">Length (inches)</label>
        <input id="length" type="number" v-model="length" min="1">
    </div>
    <div>
        <label for="width">Width (inches)</label>
        <input id="width" type="number" v-model="width" min="1">
    </div>
    <div>
        <label for="cost">Cost / inch:</label>
        <strong v-text="costPerInch"></strong>
    </div>
    <div>
        Estimated cost:
        <span v-text="estimate"></span>
    </div>
</div>

<script src="https://unpkg.com/vue@3"></script>
<script defer>
    let { createApp } = Vue;

    createApp({
        data() {
            return {
                length: 1,
                width: 1,
                cost: 0.0175,
            }
        },

        computed: {
            estimate() {
                return this.format(this.length * this.width * this.cost);
            },

            costPerInch() {
                return this.format(this.cost);
            }
        },

        methods: {
            format(cost, type = 'USD') {
                return new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: type,
                    minimumFractionDigits: 4,
                }).format(cost);
            }
        }
    }).mount('#calc');
</script>
