<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function sales() {
        return $this->hasMany(Sale::class);
    }

    public function getProductList($search) {
        $query = $this->with('company');

        if (!empty($search['keyword'])) {
            $query->where('product_name', 'like', '%' . $search['keyword'] . '%');
        }

        if (!empty($search['company_id'])) {
            $query->where('company_id', $search['company_id']);
        }

        if (!is_null($search['min_price'] ?? null)) {
            $query->where('price', '>=', $search['min_price']);
        }

        if (!is_null($search['max_price'] ?? null)) {
            $query->where('price', '<=', $search['max_price']);
        }

        if (!is_null($search['min_stock'] ?? null)) {
            $query->where('stock', '>=', $search['min_stock']);
        }

        if (!is_null($search['max_stock'] ?? null)) {
            $query->where('stock', '<=', $search['max_stock']);
        }

        return $query->orderBy('id', 'desc')->get();
    }

    public function getProductById($id) {
        return $this->with('company')->findOrFail($id);
    }

    public function registerProduct($data, $img_path) {
        return $this->create([
            'company_id' => $data['company_id'],
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
            'img_path' => $img_path,
        ]);
    }

    public function updateProduct($id, $data, $img_path) {
        $product = $this->findOrFail($id);

        $update_data = [
            'company_id' => $data['company_id'],
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
        ];

        if ($img_path) {
            $update_data['img_path'] = $img_path;
        }

        return $product->update($update_data);
    }

    public function deleteProduct($id) {
        $product = $this->findOrFail($id);

        return $product->delete();
    }

    public function getProductForPurchase($id) {
        return $this->lockForUpdate()->findOrFail($id);
    }

    public function decreaseStock($product) {
        return $product->decrement('stock');
    }
}
