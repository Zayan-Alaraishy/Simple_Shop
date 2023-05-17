<body>
<h1>Create Product</h1>

<form action="/products" method="POST">
    @csrf

    <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        <label for="description">Description</label>
        <textarea name="description">{{ old('description') }}</textarea>
    </div>

    <div>
        <label for="category_id">Category</label>
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="unit_price">Unit Price</label>
        <input type="number" name="unit_price" step="0.01" value="{{ old('unit_price') }}">
    </div>

    <div>
        <label for="visibility">Visibility</label>
        <input type="checkbox" name="visibility" value="1" {{ old('visibility') ? 'checked' : '' }}>
    </div>

    <div>
        <label for="stock">Stock</label>
        <input type="number" name="stock" value="{{ old('stock') }}">
    </div>

    <button type="submit">Create</button>
</form>

</body>