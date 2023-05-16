<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{

    protected $productService;

    /**
     * ProductController Constructor
     *
     * @param ProductService $productService
     *
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
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
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $message = '';

        try {
            $this->productService->saveProduct($request);
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
        return view('product.show')
            ->with('product', $product);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productService->getProductById($id);

        return view('product.edit')
            ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $message = '';

        try {
            $this->productService->updateProductById($request, $id);

            $message = 'Your product has been updated!';
        } catch (\Exception $e) {
            $message = 'Failed to update the product!';
        }

        return redirect('/products')
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