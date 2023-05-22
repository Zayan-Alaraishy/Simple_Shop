@props(['orderItem'])

<tr class="table_row" id="{{ $orderItem->id }}">
    <td></td>
    <a href={{ route('products.show', $orderItem->id) }}>
        <div class="how-itemcart1">
            <img src="{{ asset('images/item-cart-04.jpg') }}" alt="IMG">
            <p>{{ $orderItem->name }}</p>
        </div>

    <td class="cloumn2">{{ $orderItem->unit_price }}</td>
    <td></td>
    <td class="cloumn3">{{ $orderItem->quantity }}</td>
    <td class="cloumn4"> ${{ $orderItem->unit_price * $orderItem->quantity }}</td>


</tr>
