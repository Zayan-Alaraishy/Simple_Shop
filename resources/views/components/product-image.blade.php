@if (isset($product->images[$index]))
<a href="{{ route('products.show', $product) }}">
    @if (str_contains($product->images[$index], 'dummy'))
    <img {{ $attributes->merge(["src" => $product->images[$index], "alt" => "IMG-PRODUCT"]) }}>
    @else
    <img {{ $attributes->merge(["src" => asset('storage/' . $product->images[$index]), "alt" => "IMG-PRODUCT"]) }}>
    @endif
@else
<img {{ $attributes->merge(["src" => asset('images/product-detail-01.jpg'), "alt" => "IMG-PRODUCT"]) }}>
</a>
@endif