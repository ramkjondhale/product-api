<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('product_image')) {
            $validated['product_image'] = $request->file('product_image')->store('products', 'public');
        }
        $product = Product::create($validated);
        return ['status' => true, 'data' => new ProductResource($product)];
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return ['status' => true, 'data' => new ProductResource($product)];
    }

    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validated();
        if ($request->hasFile('product_image')) {
            $validated['product_image'] = $request->file('product_image')->store('products', 'public');
        }
        $product->update($validated);
        return ['status' => true, 'data' => new ProductResource($product)];
    }

    public function destroy(string $id) {}
}
