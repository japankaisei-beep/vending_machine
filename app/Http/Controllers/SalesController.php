<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    public function purchase(Request $request) {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => '商品IDが正しくありません。',
                'errors' => $validator->errors(),
            ], 422);
        }

        DB::beginTransaction();
        try {
            $product_model = new Product();
            $product = $product_model->getProductForPurchase($request->input('product_id'));

            if ($product->stock <= 0) {
                DB::rollBack();

                return response()->json(['message' => '在庫がありません。'], 400);
            }

            $product_model->decreaseStock($product);

            $sale_model = new Sale();
            $sale_model->registerSale($product->id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['message' => '購入処理に失敗しました。'], 500);
        }

        return response()->json(['message' => '購入しました。']);
    }
}
