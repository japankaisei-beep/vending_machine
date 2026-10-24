<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product_model = new Product();
        $products = $product_model->getProductList();

        return view('product_list', compact('products'));
    }
}