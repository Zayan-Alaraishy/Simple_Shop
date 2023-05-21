@props(['cartItem'])

<tr class="table_row" id={{ $cartItem->id }}>

    <td>
        <form action={{ route('carts.destroy', ['cart' => $cartItem]) }} method="POST">
            @csrf
            @method('DELETE')

            <button type='submit' class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m ml-2">
                <i class="fs-30">&times;</i>
            </button>
        </form>
    </td>
    <td class="column-1">
        <a href={{ route('products.show', $cartItem->product) }}>
            <div class="how-itemcart1">
                <img src="{{ asset('images/item-cart-04.jpg') }}" alt="IMG">
            </div>
        </a>
    </td>
    <td class="column-2"><a href={{ route('products.show', $cartItem->product) }}>{{ $cartItem->product->name }}</a></td>
    <td class="column-3">{{ $cartItem->unit_price }}</td>
    <td class="column-4">
        <div class="wrap-num-product flex-w m-l-auto m-r-0">
            <button class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" name="num-product1"
                onclick="updateCart('down')">
                <i class="fs-16 zmdi zmdi-minus"></i>
            </button>

            <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1"
                value={{ $cartItem->desired_quantity }} onchange="updateCart()">
            <button class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" onclick="updateCart('up')">
                <i class="fs-16 zmdi zmdi-plus"></i>
            </button>

        </div>
        @if (session('out_of_stock'))
        @foreach (session('out_of_stock') as $outOfStockProduct)
            @if ( $outOfStockProduct['id'] == $cartItem->id)
                <x-error> Out of stock Only {{ $outOfStockProduct['stock'] }} available </p>
                </x-error>
            @endif
        @endforeach

    @endif
    </td>
    <td class="column-5">$ {{ $cartItem->unit_price * $cartItem->desired_quantity }}</td>
</tr>
