<body>
    <h1>Create Product</h1>

    <form action="/products" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description">{{ old('description') }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
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
            @error('category_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="unit_price">Unit Price</label>
            <input type="number" name="unit_price" step="0.01" value="{{ old('unit_price') }}">
            @error('unit_price')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="visibility">Visibility</label>
            <input type="checkbox" name="visibility" value="1" {{ old('visibility') ? 'checked' : '' }}>
            @error('visibility')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" value="{{ old('stock') }}">
            @error('stock')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="images">Images</label>
            <input type="file" name="images[]" multiple accept="image/*">
            @error('images')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Create</button>
    </form>
</body>
