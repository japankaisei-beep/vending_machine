<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request) {
        $search = $request->only([
            'keyword',
            'company_id',
            'min_price',
            'max_price',
            'min_stock',
            'max_stock',
        ]);

        $product_model = new Product();
        $products = $product_model->getProductList($search);

        $company_model = new Company();
        $companies = $company_model->getCompanyList();

        if ($request->ajax()) {
            return view('product_list_rows', compact('products'));
        }

        return view('product_list', compact('products', 'companies', 'search'));
    }

    public function show($id) {
        $product_model = new Product();
        $product = $product_model->getProductById($id);

        return view('product_detail', compact('product'));
    }

    public function create() {
        $company_model = new Company();
        $companies = $company_model->getCompanyList();

        return view('product_create', compact('companies'));
    }

    public function store(ProductRequest $request) {
        $img_path = null;
        if ($request->hasFile('img_path')) {
            $file_path = $request->file('img_path')->store('images', 'public');
            $img_path = 'storage/' . $file_path;
        }

        DB::beginTransaction();
        try {
            $product_model = new Product();
            $product_model->registerProduct($request->all(), $img_path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', '商品の登録に失敗しました。');
        }

        return redirect()->route('products.create')->with('success', '商品を登録しました。');
    }

    public function edit($id) {
        $product_model = new Product();
        $product = $product_model->getProductById($id);

        $company_model = new Company();
        $companies = $company_model->getCompanyList();

        return view('product_edit', compact('product', 'companies'));
    }

    public function update(ProductRequest $request, $id) {
        $img_path = null;
        if ($request->hasFile('img_path')) {
            $file_path = $request->file('img_path')->store('images', 'public');
            $img_path = 'storage/' . $file_path;
        }

        DB::beginTransaction();
        try {
            $product_model = new Product();
            $product_model->updateProduct($id, $request->all(), $img_path);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', '商品の更新に失敗しました。');
        }

        return redirect()->route('products.edit', $id)->with('success', '商品を更新しました。');
    }

    public function destroy(Request $request, $id) {
        DB::beginTransaction();
        try {
            $product_model = new Product();
            $product_model->deleteProduct($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->ajax()) {
                return response()->json(['message' => '商品の削除に失敗しました。'], 500);
            }

            return redirect()->route('products.index')->with('error', '商品の削除に失敗しました。');
        }

        if ($request->ajax()) {
            return response()->json(['message' => '商品を削除しました。']);
        }

        return redirect()->route('products.index')->with('success', '商品を削除しました。');
    }
}
