
<x-layout>
    <!-- Product -->
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <a href="{{ route('products.index', ['category' => '', 'name' => request('name'), 'sort_by' => request('sort_by')]) }}"
                    class="{{ request('category') == ''  ? 'active-link' : '' }} stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">All Products</a>
                @forelse ( $categories as $categoryItem )           
                     <a href="{{ route('products.index', ['category' => $categoryItem->name, 'name' => request('name'), 'sort_by' => request('sort_by')]) }}"
                        class="{{ request('category') == $categoryItem->name  ? 'active-link' : '' }} stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"> {{ $categoryItem->name }}</a>
                @empty
                    
                @endforelse
            </div>

            <div class="flex-w flex-c-m m-tb-10">
                <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                    <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                    <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                     Filter
                </div>

                <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                    <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                    <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                    Search
                </div>
            </div>
            
            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <form action="/products" method="GET">
                    <div class="bor8 dis-flex p-l-15">
                        <button type="submit" class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{request('category')}}" />
                        @endif 
                        @if(request('sort_by'))
                            <input type="hidden" name="sort_by" value="{{request('sort_by')}}" />
                        @endif 
                        
                        <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" id="name" name="name" value="{{ request('name') }}" placeholder="Search">
                    </div>	
                </form>
                
            </div>
            
            <!-- Filter -->
            <div class="dis-none panel-filter w-full p-t-10">
                <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                    <div class="filter-col1 p-r-15 p-b-27">
                        <div class="mtext-102 cl2 p-b-15">
                            Sort By
                        </div>

                        <ul>
                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['category' => request('category'), 'name' => request('name'), 'sort_by' => 'name']) }}"
                                class="{{ request('sort_by') == 'name' ? 'active-link' : '' }} filter-link stext-106 trans-04">Name</a>
                            </li>
                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['category' => request('category'), 'name' => request('name'), 'sort_by' => 'category']) }}"
                                class="{{ request('sort_by') == 'category' ? 'active-link' : '' }} filter-link stext-106 trans-04">Category</a>
                            </li>
                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['category' => request('category'), 'name' => request('name'), 'sort_by' => 'unit_price']) }}"
                                class="{{ request('sort_by') == 'unit_price' ? 'active-link' : '' }} filter-link stext-106 trans-04">Price: Low to High</a>
                            </li>
                            <li class="p-b-6">
                                <a href="{{ route('products.index', ['category' => request('category'), 'name' => request('name'), 'sort_by' => 'average_rating']) }}"
                                class="{{ request('sort_by') == 'average_rating' ? 'active-link' : '' }} filter-link stext-106 trans-04">Ratings</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row isotope-grid">
            @forelse ( $products as $product )
                <x-product_card :product="$product"/>
            @empty
                <h2>No products found</h2>
            @endforelse
        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            {{$products->links()}}
            {{-- {{$products->links}} --}}
        </div>
    </div>
</div>





</x-layout>
    <script>
        console.log('hello');
        var products = <?php echo $products; ?>;
        console.log(products);
    </script>
