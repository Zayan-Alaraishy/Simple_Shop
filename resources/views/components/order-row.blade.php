@props(['orderItem'])

<tr class="table_row" id="{{ $orderItem->id }}">
    <td class="column-1">
        <a href={{ route('products.show', $orderItem->id) }}>
            <div class="how-itemcart1">
                <x-product-image index='0' :product="$orderItem->product" />
            </div>
        </a>
    </td>
    <td class="column-2">
        <a href={{ route('products.show', $orderItem->id) }}>
            {{ $orderItem->name }}</a>
    </td>
    <td class="cloumn3">{{ $orderItem->unit_price }}</td>
    <td></td>
    <td class="cloumn4">{{ $orderItem->quantity }}</td>
    <td class="cloumn5"> ${{ $orderItem->unit_price * $orderItem->quantity }}</td>

</tr>
