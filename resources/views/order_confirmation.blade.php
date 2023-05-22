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
    <div class="container">
        <div class="dis-flex flex-col flex-m bor12 p-t-15 p-b-30">
            <div class="size-210 p-r-18 p-r-0-sm w-full-ssm">
                <h4 class="mtext-105 cl2 js-name-detail p-b-14 txt-center">
                    Order Details
                </h4>
                <div class="p-t-15 row">
                    <div class="col">
                        <div class="bg0 m-b-12">
                            <p>Total Price</p>
                            <x-input type="text" value="{{ $orderDetails->first()->total_price }}" readonly />
                        </div>
                        <div class="bg0 m-b-12">
                            <p>Order Date</p>
                            <x-input type="text" value="{{ $orderDetails->first()->created_at->format('Y-m-d') }}"
                                readonly />
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg0 m-b-12">
                            <p>Payment Method</p>
                            <x-input type="text" value="{{ $orderDetails->first()->payment_method }}" readonly />
                        </div>
                        <div class="bg0 m-b-12">
                            <p>Money Received</p>
                            <x-input type="text" readonly value="{{ $orderDetails->first()->money_received }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <th class="column-2"></th>
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
