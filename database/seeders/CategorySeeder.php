<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $cateogries = ['Sayuran', 'Makanan Berat', 'jajanan', 'Protein', 'Buah-buahan', 'Minuman', 'Makanan Ringan', 'Makanan Penutup', 'Makanan Khas', 'Makanan Sehat', 'Makanan Tradisional', 'Makanan Pedas', 'Makanan Manis', 'Makanan Asin', 'Makanan Gurih', 'Makanan Enak', 'Makanan Murah', 'Makanan Mahal', 'Makanan Sehari-hari', 'Makanan Diet', 'Makanan Kekinian', 'Makanan Hits', 'Makanan Unik', 'Makanan Lezat', 'Makanan Enak', 'Makanan Sehat', 'Makanan Bergizi', 'Makanan Penuh Gizi', 'Makanan Penuh Nutrisi', 'Makanan Penuh Vitamin', 'Makanan Penuh Protein', 'Makanan Penuh Karbohidrat', 'Makanan Penuh Serat', 'Makanan Penuh Mineral', 'Makanan Penuh Kalori', 'Makanan Penuh Lemak', 'Makanan Penuh Gula', 'Makanan Penuh Garam', 'Makanan Penuh Kolesterol', 'Makanan Penuh Kafein', 'Makanan Penuh MSG', 'Makanan Penuh Gluten', 'Makanan Penuh Laktosa', 'Makanan Penuh Telur', 'Makanan Penuh Kacang', 'Makanan Penuh Udang', 'Makanan Penuh Ikan', 'Makanan Penuh Daging', 'Makanan Penuh Ayam', 'Makanan Penuh Sapi', 'Makanan Penuh Kambing', 'Makanan Penuh Bebek', 'Makanan Penuh Angsa', 'Makanan Penuh Burung', 'Makanan Penuh Tahu', 'Makanan Penuh Tempe', 'Makanan Penuh Susu', 'Makanan Penuh Keju', 'Makanan Penuh Yogurt', 'Makanan Penuh Es Krim', 'Makanan Penuh Kue', 'Makanan Penuh Roti', 'Makanan Penuh Pasta', 'Makanan Penuh Pizza', 'Makanan P'];

        foreach ($cateogries as $category) {
            Category::factory()->create([
                'name' => $category,
            ]);
        }
    }
}
