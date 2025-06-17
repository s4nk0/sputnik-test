<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function prices(Request $request)
    {
        $request->validate([
            'currency'=>'nullable|string|in:USD,EUR,RUB',
        ]);
        return ProductResource::collection(Product::latest()->get());
    }
}
