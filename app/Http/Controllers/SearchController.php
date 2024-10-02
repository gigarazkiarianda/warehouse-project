<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gudang;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');


        if (empty($query)) {

            return redirect()->back()->with('message', 'Please enter a search term.');
        }


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
