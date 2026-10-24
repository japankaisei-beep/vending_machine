<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id');

        $product_model = new Product();
        $products = $product_model->getProductList($keyword, $company_id);

        $company_model = new Company();
        $companies = $company_model->getCompanyList();

        return view('product_list', compact('products', 'companies', 'keyword', 'company_id'));
    }

    public function show($id)
    {
        $product_model = new Product();
        $product = $product_model->getProductById($id);

        return view('product_detail', compact('product'));
    }
    
    public function create()
    {
        $company_model = new Company();
        $companies = $company_model->getCompanyList();

        return view('product_create', compact('companies'));
    }
}