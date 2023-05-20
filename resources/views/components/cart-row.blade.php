@props(['cartItem'])

<tr class="table_row">
    <td>
        <form action={{route('carts.destroy', ['cart' => $cartItem])}} method="POST">
            @csrf
            @method('DELETE')

            <button type='submit' class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m ml-2">
                <i class="fs-30">&times;</i>
            </button>
        </form>
    </td>
    <td class="column-1">
        <a href={{route('products.show', $cartItem->product)}}>
            <div class="how-itemcart1">
                <img src="{{asset('images/item-cart-04.jpg')}}" alt="IMG">
            </div>
        </a>
    </td>
    <td class="column-2"><a href={{route('products.show', $cartItem->product)}}>{{$cartItem->product->name}}</a></td>
    <td class="column-3">{{$cartItem->unit_price}}</td>
    <td class="column-4">
        <div class="wrap-num-product flex-w m-l-auto m-r-0">
            <form action={{route('carts.update', ['cart' => $cartItem])}} method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="desired_quantity" value="-1" />
                <input type="hidden" name="quantity" value="-1" />
                <button type='submit' class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                    <i class="fs-16 zmdi zmdi-minus"></i>
                </button>
            </form>

            <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value={{$cartItem->desired_quantity}}>

            <form action={{route('carts.update', ['cart' => $cartItem])}}  method="POST">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="desired_quantity" value="1" />
                <input type="hidden" name="quantity" value="1" />

                <button type='submit' class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                    <i class="fs-16 zmdi zmdi-plus"></i>
                </button>
            </form>
        </div>
    </td>
    <td class="column-5">$ {{$cartItem->unit_price * $cartItem->desired_quantity}}</td>
</tr>