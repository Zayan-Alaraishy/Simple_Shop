<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{

    protected $productService;
    protected $categoryService;

    /**
     * ProductController Constructor
     *
     * @param ProductService $productService
     *
     */
    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $visibility = $request->input('visibility');
        $category = $request->input('category');
        $name = $request->input('name');
        $sortBy = $request->input('sort_by');
        $perPage = $request->input('per_page');

        $products = $this->productService->getProducts($category, $name, $sortBy, $perPage);

        $categories = Category::all();
        return view('products.index', compact('products', 'categories'));
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
            dd($e);
            dd("Hello");
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

        $isAdmin = Auth::check() && Auth::user()->isAdmin();

        if ($isAdmin) {
            return view('product.admin_show')->with('product', $product);

        } else {
            return view('product.customer_show')->with('product', $product);
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
