<x-layout>
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                Order
            </span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <div class="bg0 p-t-75 p-b-85">
        <div style="display: flex; justify-content:center; align-items:center; gap:20px; margin-bottom:30px;">
            <p>Total Price</p>
            <x-input type="text" style="width:10%" value="{{ $orderDetails->first()->total_price }}" readonly />
            <p>Order Date</p>
            <x-input type="text" style="width:10%" value="{{ $orderDetails->first()->created_at->format('Y-m-d') }}"
                readonly />
            <p>Payment Method</p>
            <x-input type="text" style="width:10%" value="{{ $orderDetails->first()->payment_method }}" readonly />
            <p>Money Received</p>
            <x-input type="text" style="width:10%" readonly value="{{ $orderDetails->first()->money_received }}" />
        </div>


        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th></th>
                                    <th class="column-1">Product</th>
                                    <th class="column-3">Price</th>
                                    <th class="column-4">Quantity</th>
                                    <th class="column-5">Total</th>
                                </tr>
                                @isset($orderDetails)
                                    @forelse ($orderDetails as $orderItem)
                                        <x-order-row :orderItem="$orderItem" />
                                    @empty
                                    @endforelse
                                @endisset
                            </table>
                        </div>

                        <div class="flex-w bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm w-full">
                            <form id='update-cart' method="POST" action={{ route('carts.bulkUpdate') }}
                                class="flex-row flex-r w-full">

                            </form>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
    </div>
    </div>
</x-layout>
