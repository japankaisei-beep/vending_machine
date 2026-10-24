@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="product-edit__title">商品情報編集画面</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
        class="product-edit__form">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">ID</label>
            <p>{{ $product->id }}</p>
        </div>

        <div class="mb-3">
            <label for="product_name" class="form-label">商品名<span class="text-danger">*</span></label>
            <input type="text" name="product_name" id="product_name" class="form-control"
                value="{{ old('product_name', $product->product_name) }}">
            @error('product_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="company_id" class="form-label">メーカー名<span class="text-danger">*</span></label>
            <select name="company_id" id="company_id" class="form-select">
                <option value="">選択してください</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}"
                        @selected(old('company_id', $product->company_id) == $company->id)>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
            @error('company_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">価格<span class="text-danger">*</span></label>
            <input type="number" name="price" id="price" class="form-control"
                value="{{ old('price', $product->price) }}">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">在庫数<span class="text-danger">*</span></label>
            <input type="number" name="stock" id="stock" class="form-control"
                value="{{ old('stock', $product->stock) }}">
            @error('stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">コメント</label>
            <textarea name="comment" id="comment" class="form-control"
                rows="3">{{ old('comment', $product->comment) }}</textarea>
            @error('comment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="img_path" class="form-label">商品画像</label>
            @if ($product->img_path)
                <div class="mb-2">
                    <img src="{{ asset($product->img_path) }}" alt="商品画像" width="100">
                </div>
            @endif
            <input type="file" name="img_path" id="img_path" class="form-control">
            @error('img_path')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
