<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Gudang;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Import facade Auth

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $gudangs = Gudang::all();


        $selectedGudangId = $request->input('gudang_id');


        $products = $selectedGudangId
            ? Product::where('gudang_id', $selectedGudangId)->get()
            : Product::all();


        $user = Auth::user();


        return view('dashboard', compact('products', 'gudangs', 'selectedGudangId', 'user'));
    }
}
