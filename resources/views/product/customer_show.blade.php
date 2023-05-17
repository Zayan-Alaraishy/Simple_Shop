<body style="font-family: Arial, Helvetica, sans-serif; padding:0.5em">
    <h3>{{ $product->name }}</h3>
    <h3>Average rating: {{ $product->average_rating }}</h3>
    <p><strong>Description:</strong> {{ $product->description }}</p>
    <p><strong>Category:</strong> {{ $product->category->name }}</p>
    <p><strong>Price:</strong> ${{ $product->unit_price }}</p>
<!-- 
    TOOD:rating and comment
    @if (Auth::check())
    
    <form method="POST" action="/product/{{ $product->id }}/rate">
        @csrf

        <label for="rating">Rating:</label>
        <div>
            @for ($i = 1; $i<= 5; $i++)
                <button type="submit" data-rating="{{ $i }}">{{ $i }}</button>    
            @endfor
        </div>
    </form>
    <input type="text" name="rating" id="selected-rating" value="{{ isset($user_review) ? $user_review->rating : '' }}">   
    <br>
    @if ($user_review)
        <p>Your rating: {{ $user_review->rating }}</p>
        @if ($user_review->comment)
            <p>Your comment: {{ $user_review->comment }}</p>
            <button>Edit Comment</button>
        @else
            <input type="text" name="comment" placeholder="Add comment">
        @endif
    @else
        <input type="text" name="comment" placeholder="Add comment">
    @endif

    @endif -->
    <!-- View all the comments on this product -->
</body>
                    