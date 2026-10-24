<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_name' => 'required|max:255',
            'company_id' => 'required|integer|exists:companies,id',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|max:10000',
            'img_path' => 'nullable|image|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'product_name' => '商品名',
            'company_id' => 'メーカー名',
            'price' => '価格',
            'stock' => '在庫数',
            'comment' => 'コメント',
            'img_path' => '商品画像',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attributeは必須項目です。',
            'max' => ':attributeは:max文字以内で入力してください。',
            'integer' => ':attributeは数字で入力してください。',
            'min' => ':attributeは:min以上で入力してください。',
            'exists' => ':attributeを正しく選択してください。',
            'image' => ':attributeには画像ファイルを選択してください。',
            'img_path.max' => ':attributeは2MB以下のファイルを選択してください。',
        ];
    }
}