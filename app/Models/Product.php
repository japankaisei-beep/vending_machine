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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function getProductList($keyword, $company_id)
    {
        $query = $this->with('company');

        if ($keyword) {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }

        if ($company_id) {
            $query->where('company_id', $company_id);
        }

        return $query->get();
    }

    public function getProductById($id)
    {
        return $this->with('company')->findOrFail($id);
    }

    public function registerProduct($data, $img_path)
    {
        return $this->create([
            'company_id' => $data['company_id'],
            'product_name' => $data['product_name'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'comment' => $data['comment'],
            'img_path' => $img_path,
        ]);
    }
}
