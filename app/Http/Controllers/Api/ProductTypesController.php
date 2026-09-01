<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductTypeRequest;
use App\Http\Requests\UpdateProductTypeRequest;
use App\Http\Resources\ProductTypeResource;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypesController extends Controller
{
    public function index()
    {
        $productType = ProductType::latest()->paginate(10);
        return ProductTypeResource::collection($productType);
    }

    public function store(StoreProductTypeRequest $request)
    {
        $validate = $request->validated();
        $productType = ProductType::create($validate);
        return ['status' => true, 'data' => new ProductTypeResource($productType)];
    }

    public function show(string $id)
    {
        $productType = ProductType::findOrFail($id);
        return new ProductTypeResource($productType);
    }

    public function update(UpdateProductTypeRequest $request, string $id)
    {
        $productType = ProductType::findOrFail($id);
        $productType->update($request->validated());
        return ['status' => true, 'data' => new ProductTypeResource($productType)];
    }

    public function destroy(string $id)
    {
        $productType = $this->show($id);
        $productType->delete();
        return ['status' => true, 'message' => 'Deleted Successfully'];
    }
}
