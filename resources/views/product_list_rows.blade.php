@forelse ($products as $product)
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
        <td>
            <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">詳細</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm js-delete-button">削除</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center">該当する商品がありません</td>
    </tr>
@endforelse
