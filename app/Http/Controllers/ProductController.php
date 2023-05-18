<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\RatingService;
use Illuminate\Support\Facades\Auth;


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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();

        return view('product.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $message = '';

        try {
            $this->productService->saveProduct($request->validated());
            $message = 'Your product has been added!';
        } catch (\Exception $e) {
            $message = 'Failed to create this product!';
        }

        return redirect('/products')
            ->with('message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $product = $this->productService->getProductById($id);

        $user_review = $this->ratingService->getUserRatingForProduct($id, auth()->id());

        $isAdmin = Auth::check() && Auth::user()->isAdmin();

        if ($isAdmin) {
            return view('product.admin_show')->with('product', $product);

        } else {
            return view('product.customer_show')->with(['product' => $product, 'user_review' => $user_review]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productService->getProductById($id);
        $categories = $this->categoryService->getAllCategories();

        return view('product.edit')
            ->with([
                'product' => $product,
                'categories' => $categories
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $message = '';

        try {
            $this->productService->updateProductById($id, $request->validated());

            $message = 'Your product has been updated!';
        } catch (\Exception $e) {
            $message = 'Failed to update the product!';
        }

        return redirect('/products/' . $id)
            ->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';

        try {
            $this->productService->deleteProductById($id);
            $message = "Your product has been deleted!";

        } catch (\Exception $e) {
            $message = "Failed to delete this product!";
        }

        return back()
            ->with('message', $message);
    }
}