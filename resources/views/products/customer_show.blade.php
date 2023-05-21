<x-layout>
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('products.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

                <a href="{{ route('products.index', ['category' => $product->category->name]) }}"
                    class="stext-109 cl8 hov-cl1 trans-04">
                    {{ $product->category->name }}
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>

        <span class="stext-109 cl4">
            {{ $product->name }}
        </span>
    </div>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"><ul class="slick3-dots" role="tablist" style=""><li class="slick-active" role="presentation"><img src="{{asset('images/product-detail-01.jpg')}}"><div class="slick3-dot-overlay"></div></li><li role="presentation"><img src="{{asset('images/product-detail-02.jpg')}}"><div class="slick3-dot-overlay"></div></li><li role="presentation"><img src="{{asset('images/product-detail-03.jpg')}}"><div class="slick3-dot-overlay"></div></li></ul></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"><button class="arrow-slick3 prev-slick3 slick-arrow" style=""><i class="fa fa-angle-left" aria-hidden="true"></i></button><button class="arrow-slick3 next-slick3 slick-arrow" style=""><i class="fa fa-angle-right" aria-hidden="true"></i></button></div>

							<div class="slick3 gallery-lb slick-initialized slick-slider slick-dotted">
								<div class="slick-list draggable"><div class="slick-track" style="opacity: 1; width: 1083px;"><div class="item-slick3 slick-slide slick-current slick-active" data-thumb="images/product-detail-01.jpg" data-slick-index="0" aria-hidden="false" tabindex="0" role="tabpanel" id="slick-slide10" aria-describedby="slick-slide-control10" style="width: 361px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
									<div class="wrap-pic-w pos-relative">
                                        @if(isset($product->images[0]))
										    <img src="{{Storage::url($product->images[0])}}" alt="IMG-PRODUCT">
                                        @else
										    <img src={{asset('images/product-detail-01.jpg')}} alt="IMG-PRODUCT">
                                        @endif
                                        

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('images/product-detail-01.jpg')}}" tabindex="0">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div><div class="item-slick3 slick-slide" data-thumb="{{asset('images/product-detail-02.jpg')}}" data-slick-index="1" aria-hidden="true" tabindex="-1" role="tabpanel" id="slick-slide11" aria-describedby="slick-slide-control11" style="width: 361px; position: relative; left: -361px; top: 0px; z-index: 998; opacity: 0;">
									<div class="wrap-pic-w pos-relative">
                                        @if(isset($product->images[1]))
										    <img src="{{Storage::url($product->images[1])}}" alt="IMG-PRODUCT">
                                        @else
										    <img src={{asset('images/product-detail-01.jpg')}} alt="IMG-PRODUCT">
                                        @endif
										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('images/product-detail-02.jpg')}} tabindex="-1">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div><div class="item-slick3 slick-slide" data-thumb="{{asset('images/product-detail-03.jpg')}}" data-slick-index="2" aria-hidden="true" tabindex="-1" role="tabpanel" id="slick-slide12" aria-describedby="slick-slide-control12" style="width: 361px; position: relative; left: -722px; top: 0px; z-index: 998; opacity: 0;">
									<div class="wrap-pic-w pos-relative">
                                        @if(isset($product->images[2]))
										    <img src="{{Storage::url($product->images[2])}}" alt="IMG-PRODUCT">
                                        @else
										    <img src={{asset('images/product-detail-03.jpg')}} alt="IMG-PRODUCT">
                                        @endif
										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('images/product-detail-03.jpg')}} tabindex="-1">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div></div></div>
								
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							{{ $product->name }}
						</h4>

						<p class="mtext-106 cl2 p-b-14">
							${{ $product->unit_price }}
						</p>

						<p class="mtext-106 cl2 p-b-16">
							@if($product->stock)
								@if($product->stock > 10)
									<span style="color: green;">In Stock<span>
								@elseif($product->stock > 2)
									<span style="color: purple;">Hurry, we have {{$product->stock}} items left.<span>
								@else
									<span style="color: red;">Out of Stock<span>
								@endif		
							@endif
						</p>

						<p class="stext-102 cl3 p-t-23">
							{{$product->description}}
						</p>
                        <!--Rating average-->

                        <span class="fs-18 cl11">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $product->average_rating)
                                <i class="item-rating pointer zmdi zmdi-star"></i>
                            @else
                                <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                            @endif
                        @endfor
                        </span>
                        <!--  -->

						<div class="size-204 flex-w flex-m respon6-next">
							<form action="{{route('carts.store')}}" method="POST">
								@csrf
							<div class="wrap-num-product flex-w m-r-20 m-tb-10">
								<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
									<i class="fs-16 zmdi zmdi-minus"></i>
								</div>

								<input class="mtext-104 cl3 txt-center num-product" type="number" name="desired_quantity" value="1">

								<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
									<i class="fs-16 zmdi zmdi-plus"></i>
								</div>
							</div>

							<input type="hidden" name="product_id" value="{{$product->id}}" />
							<button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
								Add to cart
							</button>
						</form>
						</div>
						<!--  -->

						<!--  -->
						<div class="flex-w flex-m p-l-100 p-t-40 respon7">
							<div class="flex-m bor9 p-r-10 m-r-11">
								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
									<i class="zmdi zmdi-favorite"></i>
								</a>
							</div>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
								<i class="fa fa-facebook"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
								<i class="fa fa-twitter"></i>
							</a>

							<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
								<i class="fa fa-google-plus"></i>
							</a>
						</div>
					</div>
				</div>
			</div>

            <div class="bor10 m-t-50 m-b-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description"
                                role="tab">Description</a>
                        </li>


                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews
                                ({{ count($productReviews) }})</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        @foreach ($productReviews as $review)
                                            <x-review :review="$review" />
                                        @endforeach
                                        {{-- <div class="flex-c-m flex-w w-full p-t-45">
                                            {{ $productReviews->links() }}
                                        </div> --}}
                                        <!-- Add review -->
                                        <form class="w-full" method="post"
                                            action="{{ route('products.ratings.store', ['id' => $product->id]) }}">
                                            @csrf
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Add a review
                                            </h5>

                                            <p class="stext-102 cl6">
                                                Share your review, To improve our service..
                                            </p>
                                            <!-- Hidden input field for the product ID -->
                                            <input type="hidden" name="product_id"
                                                value="{{ $product->id }}">

                                            <div class="flex-w flex-m p-t-50 p-b-23">
                                                <span class="stext-102 cl3 m-r-16">
                                                    Your Rating
                                                </span>

                                                <span class="wrap-rating fs-18 cl11 pointer">
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                                    <input class="dis-none" type="number" name="rating">
                                                </span>
                                            </div>

                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review">Your
                                                        review</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="comment"></textarea>
                                                </div>
                                            </div>

                                            <button
                                                class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</x-layout>
