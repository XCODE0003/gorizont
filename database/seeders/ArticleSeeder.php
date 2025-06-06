<?php

namespace Database\Seeders;

use App\Models\Articles;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создание 20 статей
        Articles::factory()->count(20)->create();
    }
}