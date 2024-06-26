@props(['cartItem'])

<li class="header-cart-item flex-w flex-t m-b-12">
    <div class="header-cart-item-img">
        <x-product-image index='0' :product="$cartItem->product" />
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
