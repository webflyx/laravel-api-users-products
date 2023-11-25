<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with([
            'users' => function ($query) {
                $query->select('id', 'first_name', 'last_name');
            }
        ])->get();
        
        return ProductResource::collection($products);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
