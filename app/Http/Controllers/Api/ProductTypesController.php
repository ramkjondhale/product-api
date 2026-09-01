<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Http\Resources\ProductTypeResource;
use App\Models\ProductType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductTypesController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $productType = ProductType::with('products')->latest()->paginate(10);
        return ProductTypeResource::collection($productType);
    }

    public function store(StoreProductTypeRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $productType = ProductType::create($validated);
        return (new ProductTypeResource($productType))->response()->setStatusCode(201);
    }

    public function show(string $id): ProductTypeResource
    {
        $productType = ProductType::findOrFail($id);
        return new ProductTypeResource($productType);
    }

    public function update(UpdateProductTypeRequest $request, string $id): JsonResponse
    {
        $productType = ProductType::findOrFail($id);
        $productType->update($request->validated());
        return (new ProductTypeResource($productType))->response()->setStatusCode(200);
    }

    public function destroy(string $id): JsonResponse
    {
        $productType = ProductType::findOrFail($id);
        $productType->delete();
        return response()->json(['status' => true, 'message' => 'Deleted Successfully'], 200);
    }
}
