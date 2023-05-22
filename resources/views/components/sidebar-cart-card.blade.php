@props(['cartItem'])

<li class="header-cart-item flex-w flex-t m-b-12">
    <div class="header-cart-item-img">
        @if(isset($cartItem->product->images[0]))
        <img src="{{ asset('storage/' . $cartItem->product->images[0]) }}" alt="IMG-PRODUCT">
        @else
            <img src={{asset('images/product-detail-01.jpg')}} alt="IMG-PRODUCT">
        @endif
    </div>

    <div class="header-cart-item-txt p-t-8">
        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
           {{$cartItem->product->name}}
        </a>

        <span class="header-cart-item-info">
            {{$cartItem->desired_quantity}} x ${{$cartItem->unit_price}}
        </span>
    </div>
</li>
