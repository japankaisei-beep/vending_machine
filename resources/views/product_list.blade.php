@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="product-list__title">商品一覧画面</h1>

    <form action="{{ route('products.index') }}" method="GET" class="product-search mb-4">
        <div class="row g-2">
            <div class="col-md-5">
                <input type="text" name="keyword" class="form-control" placeholder="検索キーワード" value="{{ $keyword }}">
            </div>
            <div class="col-md-4">
                <select name="company_id" class="form-select">
                    <option value="">メーカー名</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" @selected($company_id == $company->id)>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-secondary">検索</button>
            </div>
        </div>
    </form>

    <table class="table product-list__table">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="product-list__item">
                    <td>{{ $product->id }}</td>
                    <td>
                        @if ($product->img_path)
                            <img src="{{ asset($product->img_path) }}" alt="商品画像" width="50">
                        @endif
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company->company_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection