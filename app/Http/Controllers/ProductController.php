<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        // Validate and store the product
        $data =$request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|decimal:2|min:0',
            'description' => 'nullable|string',
            'stock_quantity' => 'required|integer|min:1',
        ]);

        // Assuming you have a Product model
        $newProduct = Product::create($data);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product)
    {
        // Validate and update the product
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|decimal:2|min:0',
            'description' => 'nullable|string',
            'stock_quantity' => 'required|integer|min:1',
        ]);

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
