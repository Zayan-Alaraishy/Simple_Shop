<script>
    let cartItems = {{ Js::from($cartItems) }};
    window.addEventListener('load', () => {
        updateCart();
    });

    function updateCart(action, cartItemId) {
        let form = document.getElementById("update-cart");

        cartItems.map((item) => {
            if(item.desired_quantity == 0) return item;
            let input = document.getElementById(item.id).querySelector('.num-product');
            
            if (action == 'zero' && item.id == cartItemId) {
                input.value = 0;
            }
            
            if (action == 'down') {
                item.desired_quantity = parseInt(input.value) - 1;
            } else if (action == 'up') {
                item.desired_quantity = parseInt(input.value) + 1;
            } else {
                item.desired_quantity = parseInt(input.value);
            }

            // if quantity equals 0, remove the cart item element.
            if (item.desired_quantity == 0) {
                document.getElementById(item.id).remove();
            }
            
            let itemRow = document.getElementById(item.id);
            if(itemRow){
                itemTotal = itemRow.querySelector('.column-5');
                itemTotal.innerHTML = `$ ${(item.desired_quantity * item.unit_price).toFixed(2)}`;
            }
            

            let totalDivs = document.querySelectorAll('.mtext-110.cl2');

            totalDivs.forEach(item => {
                item.innerHTML = cartItems.reduce((acc, item) => {
                    let total = (acc + (item.unit_price * item.desired_quantity));
                    return total;
                }, 0).toFixed(2);
            })
            return item;
        })


        // clear form hidden inputs
        Array.from(form.children).forEach(item => {
            if (item.nodeName == 'INPUT' && item.name != '_token') {
                form.removeChild(item);
            }
        })

        // add hidden inputs for cartItems in the form
        cartItems.forEach(item => {
            let input = document.createElement('input');
            input.type = 'hidden';
            input.name = `cartitems[${item.id}]`;
            input.value = `${item.desired_quantity}`;
            form.appendChild(input);
        })
    }
</script>

<x-layout>
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Shoping Cart
            </span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <div class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th></th>
                                    <th class="column-1">Product</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Total</th>
                                </tr>
                                @isset($cartItems)
                                    @forelse ($cartItems as $cartItem)
                                        <x-cart-row :cartItem="$cartItem" />
                                    @empty
                                        @if (session('emptyCart'))
                                            <x-error>{{ session('emptyCart') }}</x-error>
                                        @endif
                                        <tr class="table_row">Your Cart is Empty</tr>
                                    @endforelse
                                @endisset
                            </table>
                        </div>

                        <div class="flex-w bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm w-full">
                            <form id='update-cart' method="POST" action={{ route('carts.bulkUpdate')  }}
                                class="flex-row flex-r w-full">
                                @csrf
                                <button type="submit"
                                    class="stext-101 cl2 size-117 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                    Update Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Cart Totals
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Subtotal:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    ${{ $cartTotal }}
                                </span>
                            </div>
                        </div>

                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    <div class="p-t-15">
                                        <span class="stext-112 cl8">
                                            Payment Method
                                        </span>

                                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                            <x-select name="payment_method">
                                                <option value="cash" selected>Cash</option>
                                                <option value="visa">Visa</option>
                                                <option value="mastercard">MasterCard</option>
                                                <option value="amex">Amex</option>
                                            </x-select>
                                        </div>
                                        <x-input type="text" name="state" value="{{ old('state') }}"
                                            placeholder='State/ country' style="margin-bottom: 10px;" />
                                        @error('state')
                                            <x-error>{{ $message }}</x-error>
                                        @enderror

                                        <x-input type="text" name="city" value="{{ old('city') }}"
                                            placeholder='City' style="margin-bottom: 10px;" />
                                        @error('city')
                                            <x-error>{{ $message }}</x-error>
                                        @enderror


                                        <x-input type="text" name="street" value="{{ old('street') }}"
                                            placeholder='Street' style="margin-bottom: 10px;" />
                                        @error('street')
                                            <x-error>{{ $message }}</x-error>
                                        @enderror

                                        <x-input type="text" name="money_received" placeholder='Pay the Bill'
                                            style="margin-bottom: 10px;" value="{{ $cartTotal }}" />
                                        @error('money_received')
                                            <x-error>{{ $message }}</x-error>
                                        @enderror

                                        @if (session('status'))
                                            <x-error>{{ session('status') }}</x-error>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
                                    <span class="mtext-101 cl2">
                                        Total:
                                    </span>
                                </div>

                                <div class="size-209 p-t-1">
                                    <span class="mtext-110 cl2">
                                        $ ${{ $cartTotal }}
                                    </span>
                                </div>
                            </div>

                            <button type="submit"
                                class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Proceed to Checkout
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
