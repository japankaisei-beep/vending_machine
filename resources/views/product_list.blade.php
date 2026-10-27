@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="product-list__title">商品一覧画面</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('products.index') }}" method="GET" class="product-search mb-4">
        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control" placeholder="検索キーワード"
                    value="{{ $search['keyword'] ?? '' }}">
            </div>
            <div class="col-md-6">
                <select name="company_id" class="form-select">
                    <option value="">メーカー名</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}"
                            @selected(($search['company_id'] ?? '') == $company->id)>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row g-2 align-items-center">
            <div class="col-md-2">
                <input type="number" name="min_price" class="form-control" placeholder="価格(下限)" min="0"
                    value="{{ $search['min_price'] ?? '' }}">
            </div>
            <div class="col-auto">〜</div>
            <div class="col-md-2">
                <input type="number" name="max_price" class="form-control" placeholder="価格(上限)" min="0"
                    value="{{ $search['max_price'] ?? '' }}">
            </div>
            <div class="col-md-2">
                <input type="number" name="min_stock" class="form-control" placeholder="在庫数(下限)" min="0"
                    value="{{ $search['min_stock'] ?? '' }}">
            </div>
            <div class="col-auto">〜</div>
            <div class="col-md-2">
                <input type="number" name="max_stock" class="form-control" placeholder="在庫数(上限)" min="0"
                    value="{{ $search['max_stock'] ?? '' }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary">検索</button>
            </div>
        </div>
    </form>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">新規登録</a>

    <table class="table product-list__table">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody class="js-product-list-body">
            @include('product_list_rows')
        </tbody>
    </table>
</div>
<script src="{{ asset('js/delete_confirm.js') }}"></script>
<script src="{{ asset('js/product_sort.js') }}"></script>
<script src="{{ asset('js/product_search.js') }}"></script>
@endsection
