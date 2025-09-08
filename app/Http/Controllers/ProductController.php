<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Basic validation rules that must exist
        $validationRules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ];

        // Add optional validation rules based on schema
        if (Schema::hasColumn('products', 'sku')) {
            $validationRules['sku'] = 'nullable|string|max:50|unique:products';
        }

        if (Schema::hasColumn('products', 'category')) {
            $validationRules['category'] = 'nullable|string|max:100';
        }

        if (Schema::hasColumn('products', 'reorder_level')) {
            $validationRules['reorder_level'] = 'nullable|integer|min:0';
        }

        // Add supplier validation
        $validationRules['supplier'] = 'nullable';

        $validated = $request->validate($validationRules);

        // Filter out fields that don't exist in the database
        $createFields = [];
        foreach ($validated as $key => $value) {
            // Special handling for supplier which maps to supplier_id
            if ($key === 'supplier' && Schema::hasColumn('products', 'supplier_id')) {
                $createFields['supplier_id'] = $value;
            } elseif (Schema::hasColumn('products', $key)) {
                $createFields[$key] = $value;
            }
        }

        $product = Product::create($createFields);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        // Basic validation rules that must exist
        $validationRules = [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ];

        // Add optional validation rules based on schema
        if (Schema::hasColumn('products', 'sku')) {
            $validationRules['sku'] = 'nullable|string|max:50|unique:products,sku,' . $product->id;
        } else {
            $validationRules['sku'] = 'nullable|string|max:50'; // Still validate format but don't check DB
        }

        if (Schema::hasColumn('products', 'category')) {
            $validationRules['category'] = 'nullable|string|max:100';
        }

        if (Schema::hasColumn('products', 'reorder_level')) {
            $validationRules['reorder_level'] = 'nullable|integer|min:0';
        }

        // Add supplier validation
        $validationRules['supplier'] = 'nullable';

        $validated = $request->validate($validationRules);

        // Filter out fields that don't exist in the database
        $updateFields = [];
        foreach ($validated as $key => $value) {
            // Special handling for supplier which maps to supplier_id
            if ($key === 'supplier' && Schema::hasColumn('products', 'supplier_id')) {
                $updateFields['supplier_id'] = $value;
            } elseif (Schema::hasColumn('products', $key)) {
                $updateFields[$key] = $value;
            }
        }

        $product->update($updateFields);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Process bulk actions on multiple products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('bulk_action');
        $selectedIds = $request->input('selected_products', []);
        
        if (empty($selectedIds) || empty($action)) {
            return redirect()->route('products.index')
                ->with('error', 'No products were selected or no action was specified.');
        }
        
        switch ($action) {
            case 'delete':
                // Delete selected products
                Product::whereIn('id', $selectedIds)->delete();
                $message = count($selectedIds) . ' products have been deleted.';
                break;
                
            case 'mark-in-stock':
                // Set stock quantity to 10 for selected products
                Product::whereIn('id', $selectedIds)->update(['stock_quantity' => 10]);
                $message = count($selectedIds) . ' products marked as in stock.';
                break;
                
            case 'mark-out-of-stock':
                // Set stock quantity to 0 for selected products
                Product::whereIn('id', $selectedIds)->update(['stock_quantity' => 0]);
                $message = count($selectedIds) . ' products marked as out of stock.';
                break;
                
            default:
                $message = 'No valid action was selected.';
        }
        
        return redirect()->route('products.index')->with('success', $message);
    }
}
