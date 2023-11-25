<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();
        Product::factory(20)->create();

        for ($i = 0; $i < 40; $i++) {
            DB::table('product_user')->insert([
                'product_id' => Product::inRandomOrder()->limit(1)->get()[0]->id,
                'user_id' => User::inRandomOrder()->limit(1)->get()[0]->id,
            ]);   
        }
    }
}
