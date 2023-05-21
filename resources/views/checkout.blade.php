<!DOCTYPE html>
<html>

<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>

<body>
    <div class="container">
        <h2>Checkout Form</h2>
        <form method="POST" action="{{ route('orders.store') }}">
            @csrf
            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method">
                    <option value="cash">Cash</option>
                    <option value="visa">Visa</option>
                    <option value="mastercard">MasterCard</option>
                    <option value="amex">Amex</option>
                </select>
                @error('payment_method')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label for="Payment Amoun">Amount:</label>
                <input type="number" id="Payment Amount" name="money_received" placeholder="Enter amount" required>
                @error('money_received')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label for="street">Street:</label>
                <input type="text" id="street" name="street" placeholder="Enter street" required>
                @error('street')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" placeholder="Enter city" value="{{   }}" required>
                @error('city')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" placeholder="Enter state" required>
                @error('state')
                    {{ $message }}
                @enderror
            </div>
            <div class="form-group">
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>

</html>
