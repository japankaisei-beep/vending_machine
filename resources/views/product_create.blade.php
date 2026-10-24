@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="product-create__title">商品新規登録画面</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="product-create__form">
        @csrf

        <div class="mb-3">
            <label for="product_name" class="form-label">商品名<span class="text-danger">*</span></label>
            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name') }}">
        </div>

        <div class="mb-3">
            <label for="company_id" class="form-label">メーカー名<span class="text-danger">*</span></label>
            <select name="company_id" id="company_id" class="form-select">
                <option value="">選択してください</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @selected(old('company_id') == $company->id)>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">価格<span class="text-danger">*</span></label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">在庫数<span class="text-danger">*</span></label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">コメント</label>
            <textarea name="comment" id="comment" class="form-control" rows="3">{{ old('comment') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="img_path" class="form-label">商品画像</label>
            <input type="file" name="img_path" id="img_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">新規登録</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection