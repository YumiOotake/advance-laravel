<?php

namespace Database\Seeders;

use App\Models\Author;
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
        $this->call(AuthorsTableSeeder::class);
        // Author::factory(10)->create();
        $this->call(PeopleTableSeeder::class);
        Product::factory(10)->create();
    }
}
