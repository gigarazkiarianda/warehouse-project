<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gudang; // Assuming Gudang is the model for warehouses
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Verify the correct column name in your 'products' table
        $products = Product::where('nama', 'like', '%' . $query . '%')->get(); // Replace 'product_name' with the actual column name in your 'products' table

        // Verify the correct column name in your 'gudangs' table
        $gudangs = Gudang::where('nama', 'like', '%' . $query . '%')->get(); // Replace 'warehouse_name' with the actual column name in your 'gudangs' table

        // Verify the correct column name in your 'users' table
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            $users = User::where('name', 'like', '%' . $query . '%')->get(); // Replace 'user_name' with the actual column name in your 'users' table
        } else {
            $users = collect(); // Empty collection if not admin
        }

        return view('search.results', compact('products', 'gudangs', 'users'));
    }
}
