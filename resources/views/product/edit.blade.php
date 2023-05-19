<h1>Edit Product</h1>

<form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ $product->name }}">
    </div>

    <div>
        <label for="description">Description</label>
        <textarea name="description">{{ $product->description }}</textarea>
    </div>

    <div>
        <label for="category_id">Category</label>
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="unit_price">Unit Price</label>
        <input type="number" name="unit_price" step="0.01" value="{{ $product->unit_price }}">
    </div>

    <div>
        <label for="visibility">Visibility</label>
        <input type="checkbox" name="visibility" value="1" {{ $product->visibility ? 'checked' : '' }}>
    </div>

    <div>
        <label for="stock">Stock</label>
        <input type="number" name="stock" value="{{ $product->stock }}">
    </div>
    <div>
        <label for="images">Images</label>
        <input type="file" name="images[]" multiple accept="image/*">
        @error('images.*')
            @error('images')
                <span class="error">{{ $message }}</span>
            @enderror

        @enderror
    </div>

    @foreach ($product['images'] as $imagePath)
        <img src="{{ Storage::url($imagePath) }}" class="card-img-top">
    @endforeach

    <button type="submit">Update</button>
</form>
