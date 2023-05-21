<!DOCTYPE html>
<html>
<head>
  <title>Order Confirmation</title>
<link rel="stylesheet" href={{ asset("css/ConfirmationOrder.css") }}">
</head>
<body>
  <div class="container">
    <h1>Order Confirmation</h1>

    <div class="order-details">
      <h2>Order Details</h2>

      @foreach ($orderItems as $item)
        <div class="order-item">
          <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}">
          <div class="product-details">
            <p><strong>Product:</strong> {{ $item->product->name }}</p>
            <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
            <p><strong>Price:</strong> ${{ $item->unit_price }}</p>
          </div>
        </div>
      @endforeach

      <div class="order-total">
        <p><strong>Total:</strong> ${{ $order->total_price }}</p>
      {{-- </div> --}}
    </div>

    <div class="thank-you">
      <p>Thank you for your order!</p>
    </div>

    <div class="back-to-home">
      <a href="/">Back to Home</a>
    </div>
  </div>
</body>
</html>
