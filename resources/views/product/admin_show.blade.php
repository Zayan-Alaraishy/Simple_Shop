<body style="font-family: Arial, Helvetica, sans-serif; padding:0.5em">
    In admin_show
    <div>
       <h3 >{{ $product->name }}</h3>
        <h3 >Average rating: {{ $product->average_rating }}</h3>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Category:</strong> {{ $product->category->name }}</p>
        <p><strong>Created at:</strong> {{ $product->created_at }}</p>
        <p><strong>Last modified at:</strong> {{ $product->updated_at }}</p>
        <p><strong>In stock:</strong> {{ $product->stock }}</p>
        <p><strong>Visibilty:</strong> {{ $product->visibility }}</p>
        <p>Reviews:</p>
        <!-- TODO: view al the commnets on this product -->
        <a href="/products/{{ $product->id }}/edit">Edit</a>  
        <form action="/products/{{ $product->id }}" method="POST">
          @csrf
          @method('delete')  
         <button type="submit" >
             Delete
         </button>
        </form>
    </div>
</body>
      
     
    

 




