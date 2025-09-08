<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total number of products
        $totalProducts = Product::count();
        
        // Get recent products (limit to 5 for dashboard)
        $products = Product::latest()->take(5)->get();
        
        // Count products added this month
        $newProductsCount = Product::whereMonth('created_at', Carbon::now()->month)
                               ->whereYear('created_at', Carbon::now()->year)
                               ->count();
        
        // Count low stock items (using a default threshold of 10 units)
        $lowStockCount = Product::where('stock_quantity', '<=', 10)->count();
        
        // Count number of distinct categories (if category column exists, otherwise return 1)
        try {
            $categoriesCount = Product::distinct('category')->count('category');
        } catch (\Exception $e) {
            $categoriesCount = 1; // Fallback if column doesn't exist
        }
        
        // Calculate total stock value (safely handle potential missing columns)
        try {
            $totalStockValue = Product::sum(DB::raw('price * stock_quantity'));
        } catch (\Exception $e) {
            // Fallback to a simpler query if there's an error
            $totalStockValue = 0;
            
            // Manually calculate if needed
            $products = Product::all();
            foreach ($products as $product) {
                if (isset($product->price) && isset($product->stock_quantity)) {
                    $totalStockValue += $product->price * $product->stock_quantity;
                }
            }
        }
        
        return view('dashboard', compact(
            'totalProducts', 
            'products', 
            'newProductsCount',
            'lowStockCount',
            'categoriesCount',
            'totalStockValue'
        ));
    }
}