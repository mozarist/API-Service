<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = product::paginate(5);

        return response()->json([
            'message' => 'List of all products',
            'data' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sku' => 'required|string|max:255|unique:products',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255'
        ]);

        $product = product::create($request->all());

        return response()->json([
            'message' => 'Product data created successfully',
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return response()->json([
            'message' => 'Product data retrieved successfully',
            'data' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $request->validate([
            'sku' => 'required|string|max:255|unique:products,sku,' . $product->id,
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255'
        ]);

        $product->update($request->all());

        return response()->json([
            'message' => 'Product data updated successfully',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product data deleted successfully'
        ]);
    }
}
