
<body style="font-family: Arial, Helvetica, sans-serif; padding:0.5em">
<div>
     <h3 >{{ $product->name }}</h3>
     <h3 >Average rating: {{ $product->average_rating }}</h3>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Category:</strong> {{ $product->category->name }}</p>
    <p><strong>Price:</strong> ${{ $product->unit_price }}</p>


    <!--................... TODO:start for admins............................. -->
    <p><strong>Created at:</strong> {{ $product->created_at }}</p>
    <p><strong>Last modified at:</strong> {{ $product->updated_at }}</p>
    <p><strong>In stock:</strong> {{ $product->stock }}</p>
    <p><strong>Visibility:</strong> {{ $product->visibility }}</p>

    <a href="/products/{{ $product->id }}/edit">
        Edit
    </a>

    <form action="/products/{{ $product->id }}" method="POST">
        @csrf
        @method('delete')

        <button type="submit" >
            Delete
        </button>
    </form>
    <!--...................:end for admins ............................. -->

    <!-- TODO:Show ratng buttonsa and commnet  for authenticated users -->
    <p>Add your rate:</p>
    <button data-rating="1">1</button>
    <button data-rating="2">2</button>
    <button data-rating="3">3</button>
    <button data-rating="4">4</button>
    <button data-rating="5">5</button>
    <div>
    <br>
    <textarea placeholder = "Add comment"></textarea>
    </div>
</div>
</body>
    
    
    



