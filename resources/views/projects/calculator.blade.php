<!doctype html>
<html class="h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Calculator</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-light h-100 d-grid align-items-center justify-content-center">
    <div id="calc" v-cloak>
        <div class="mb-3">
            <label for="length">Length (inches)</label>
            <input class="form-control" id="length" type="number" v-model="length" min="1">
        </div>
        <div class="mb-3">
            <label for="width">Width (inches)</label>
            <input class="form-control" id="width" type="number" v-model="width" min="1">
        </div>
        <div class="mb-3 d-flex justify-content-between">
            <span>Cost / inch:</span>
            <strong v-text="costPerInch"></strong>
        </div>
        <div class="d-flex justify-content-between">
            <span>Estimated cost:</span>
            <strong v-text="estimate"></strong>
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
</body>
</html>
