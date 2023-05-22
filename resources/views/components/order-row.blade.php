@props(['orderItem'])

<tr class="table_row" id="{{ $orderItem->id }}">
    {{-- <td class="cloumn1">
    <a href={{ route('products.show', $orderItem->id) }}>
        <div class="how-itemcart1">
            <img src="{{ asset('images/item-cart-04.jpg') }}" alt="IMG">
        </div>
    </a>
    <a href={{ route('products.show', $orderItem->id) }}>
        <p>{{ $orderItem->name }}</p>
    </a> --}}
    </td>
    <td class="column-1">
        <a href={{ route('products.show', $orderItem->id) }}>
            <div class="how-itemcart1">
                @if(isset($orderItem->images[0]))
                <img src="{{ asset('storage/' . $orderItem->images[0]) }}" alt="IMG-PRODUCT">
                @else
                    <img src={{asset('images/product-detail-01.jpg')}} alt="IMG-PRODUCT">
                @endif
            </div>
        </a>
    </td>
    <td class="column-2"><a href={{ route('products.show', $orderItem->id) }}>{{ $orderItem->name }}</a></td>
    <td class="cloumn3">{{ $orderItem->unit_price }}</td>
    <td></td>
    <td class="cloumn4">{{ $orderItem->quantity }}</td>
    <td class="cloumn5"> ${{ $orderItem->unit_price * $orderItem->quantity }}</td>


</tr>
