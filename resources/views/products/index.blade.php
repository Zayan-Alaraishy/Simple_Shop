<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        .filter-container {
            margin-bottom: 20px;
        }

        .filter-container select,
        .filter-container input[type="text"] {
            margin-right: 10px;
        }

        .active-link {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>

    <div class="filter-container">
        <form action="/products" method="GET">
            <label for="category">Category:</label>
            <select id="category" name="category" onchange="this.form.submit()">
                <option value="">All</option>
                @foreach ($categories as $categoryItem)
                    <option value="{{ $categoryItem->name }}" {{ request('category') == $categoryItem->name ? 'selected' : '' }}>{{ $categoryItem->name }}</option>
                @endforeach
            </select>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ request('name') }}">

            <button type="submit">Search</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>
                    <a href="{{ route('products.index', ['category' => request('category'), 'name' => request('name'), 'sort_by' => 'unit_price']) }}"
                       class="{{ request('sort_by') == 'unit_price' ? 'active-link' : '' }}">Unit Price</a>
                </th>
                <th>
                    <a href="{{ route('products.index', ['category' => request('category'), 'name' => request('name'), 'sort_by' => 'name']) }}"
                       class="{{ request('sort_by') == 'name' ? 'active-link' : '' }}">Name</a>
                </th>
                <th>
                    <a href="{{ route('products.index', ['category' => request('category'), 'name' => request('name'), 'sort_by' => 'category']) }}"
                       class="{{ request('sort_by') == 'category' ? 'active-link' : '' }}">Category</a>
                </th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->unit_price }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->appends(['category' => request('category'), 'name' => request('name'), 'sort_by' => request('sort_by')])->links() }}
</body>
</html>
