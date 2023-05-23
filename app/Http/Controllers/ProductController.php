<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\RatingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class ProductController extends Controller
{

    protected $productService;
    protected $categoryService;
    protected $ratingService;

    /**
     * ProductController Constructor
     *
     * @param ProductService $productService
     *
     */
    public function __construct(ProductService $productService, CategoryService $categoryService, RatingService $ratingService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->ratingService = $ratingService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->all();
        $products = $this->productService->getProducts($filters);
        $seconds = 60  ;
        $categories = Cache::remember('categories', $seconds, function () {
            return $this->categoryService->getAllCategories();
        });
        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();

        return view('products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $this->productService->saveProduct($request->validated());

            return redirect(route('products.index'))
                ->with('status', 'Your product has been added!');
        } catch (\Exception $e) {
            return redirect(route('products.create'))
                ->with('error', 'Failed to add the product!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $this->productService->getProductById($product->id);

        $productReviews = $this->ratingService->getProductsReviews($product->id);

        $isAdmin = Auth::check() && Auth::user()->isAdmin();

        if ($isAdmin) {
            return view('products.admin_show')->with(['product' => $product, 'productReviews' => $productReviews]);
        } else {
            return view('products.customer_show')
                ->with([
                    'product' => $product,
                    'productReviews' => $productReviews
                ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = $this->productService->getProductById($product->id);
        $categories = $this->categoryService->getAllCategories();

        return view('products.edit')
            ->with([
                'product' => $product,
                'categories' => $categories
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $this->productService->updateProductById($product->id, $request->validated());

            return redirect(route('products.show', $product))
                ->with('status', 'Your product has been updated!');
        } catch (\Exception $e) {
            return redirect(route('products.edit', $product))
                ->with('error', 'Failed to update the product!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $this->productService->deleteProductById($product->id);

            return redirect(route('products.index'))
                ->with('status', 'Your product has been deleted!');
        } catch (\Exception $e) {
            return redirect(route('products.show', $product))
                ->with('error', 'Failed to delete this product!');
        }
    }
}
