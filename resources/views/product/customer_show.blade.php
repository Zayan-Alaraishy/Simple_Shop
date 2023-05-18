<body style="font-family: Arial, Helvetica, sans-serif; padding:0.5em">
    <h3>{{ $product->name }}</h3>
    <h3>Average rating: {{ $product->average_rating }}</h3>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Category:</strong> {{ $product->category->name }}</p>
    <p><strong>Price:</strong> ${{ $product->unit_price }}</p>

</body>
                    