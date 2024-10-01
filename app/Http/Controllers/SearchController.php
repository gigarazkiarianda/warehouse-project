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


        $products = Product::where('nama', 'like', '%' . $query . '%')->get();


        $gudangs = Gudang::where('nama', 'like', '%' . $query . '%')->get();


        if (auth()->check() && auth()->user()->hasRole('admin')) {
            $users = User::where('name', 'like', '%' . $query . '%')->get();
        } else {
            $users = collect();
        }

        return view('search.results', compact('products', 'gudangs', 'users'));
    }
}
