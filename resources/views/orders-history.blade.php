<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order History</title>
    <link rel="stylesheet" href="{{ asset('css/orderHistory.css') }}">

</head>

<body>
    <x-layout>
        <form action="{{ route('orders.filter') }}" method="POST">
            <div class="filter-container">
                @csrf
                <label for="date-range" class="label">Start Date</label>
                <input type="date" id="date-range" value="{{ old('start_date') }}" name="start_date"
                    class="filter-input">

                <label for="date-range" class="label">End Date</label>
                <input type="date" id="date-range" value="{{ old('end_date') }}" name="end_date"
                    class="filter-input">


                <label for="sort-by" class="label">Sort By:</label>
                <select id="sort-by" name="sort_by" class="filter-input">
                    @error('sort_by')
                        <x-error>{{ $message }}</x-error>
                    @enderror
                    <option value="total_price" {{ old('sort_by') == 'total_price' ? ' selected' : '' }}>Total Price
                    </option>
                    <option value="created_at" {{ old('sort_by') == 'created_at' ? ' selected' : '' }}>Date Purchased
                    </option>
                </select>

                <button type="submit" class="filter-button">Filter</button>
            </div>
        </form>
        <div style="justify-content:center; align-items:center; display:flex; flex-direction:column;">
        @error('start_date')
            <x-error>{{ $message }}</x-error>
        @enderror
        @error('end_date')
            <x-error>{{ $message }}</x-error>
        @enderror
        @error('sort_by')
            <x-error>{{ $message }}</x-error>
        @enderror
    </div>
        <table class="order-table">

            <tr style="dis">

                <th>Count</th>
                <th>Toatal Price</th>
                <th>Money received</th>
                <th>Address</th>
                <th>Payment method</th>
                <th>Total Items</th>
                <th>Date</th>
            </tr>
            @foreach ($orders as $index => $order)
                <x-order-history-row :order="$order" :count="$index + 1">

                </x-order-history-row>
            @endforeach
        </table>

    </x-layout>
</body>

</html>
