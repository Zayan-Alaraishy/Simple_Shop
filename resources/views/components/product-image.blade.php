@if (isset($product->images[$index]))
<a href="{{ route('products.show', $product) }}">
    @if (str_contains($product->images[$index], 'dummy'))
    <img {{ $attributes->merge(["src" => $product->images[$index], "alt" => "IMG-PRODUCT", "style" => "object-fit: contain; width: 142%;"]) }}>
    @else
    <img {{ $attributes->merge(["src" => asset('storage/' . $product->images[$index]), "alt" => "IMG-PRODUCT", "style" => "object-fit: contain; width: 142%;"]) }}>
    @endif
</a>
@else
<img {{ $attributes->merge(["src" => asset('images/product-detail-01.jpg'), "alt" => "IMG-PRODUCT", "style" => "object-fit: contain; width: 142%;"]) }}>
</a>
@endif