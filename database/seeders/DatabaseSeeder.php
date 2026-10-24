<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $coca_cola = Company::create([
            'company_name' => 'コカ・コーラ',
            'street_address' => '東京都渋谷区',
            'representative_name' => '山田太郎',
        ]);

        $suntory = Company::create([
            'company_name' => 'サントリー',
            'street_address' => '大阪府大阪市',
            'representative_name' => '佐藤花子',
        ]);

        Product::create([
            'company_id' => $coca_cola->id,
            'product_name' => 'コカ・コーラ',
            'price' => 160,
            'stock' => 10,
            'comment' => '定番の炭酸飲料です',
        ]);

        Product::create([
            'company_id' => $coca_cola->id,
            'product_name' => '綾鷹',
            'price' => 150,
            'stock' => 5,
        ]);

        Product::create([
            'company_id' => $suntory->id,
            'product_name' => '伊右衛門',
            'price' => 150,
            'stock' => 8,
        ]);
    }
}
