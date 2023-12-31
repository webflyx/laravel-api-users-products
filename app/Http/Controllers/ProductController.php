<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with([
            'users' => function ($query) {
                $query->limitData(['id', 'first_name', 'last_name']);
            }
        ])->latest()->paginate(10);
        
        return ProductResource::collection($products);
    }

    public function store(ProductService $productService, ProductRequest $request)
    {
        $productService->create($request->validated());

        return response('Product successfully created', 200);
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load([
            'users' => function ($query) {
                $query->limitData(['id', 'first_name', 'last_name']);
            }
        ]));
    }

    public function update(ProductService $productService, ProductRequest $request, Product $product)
    {
        $productService->update($product, $request->validated());

        return response('Product successfully updated', 200);
    }

    public function destroy(ProductService $productService, Product $product)
    {
        $productService->delete($product);

        return response(status: 204);
    }
}
