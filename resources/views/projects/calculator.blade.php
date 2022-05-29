<!doctype html>
<html class="h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Calculator</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="vh-100 d-grid align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-lg-4" x-data="calc">
                    <div class="mb-3">
                        <label for="length">Length (inches)</label>
                        <input class="form-control" id="length" type="number" min="1" x-model="length">
                    </div>
                    <div class="mb-3">
                        <label for="width">Width (inches)</label>
                        <input class="form-control" id="width" type="number" min="1" x-model="width">
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <span>Cost / inch:</span>
                        <strong x-text="costPerInch"></strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Estimated cost:</span>
                        <strong x-text="estimate"></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/alpinejs" async></script>
    <script>
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
        })
    </script>
</body>
</html>
