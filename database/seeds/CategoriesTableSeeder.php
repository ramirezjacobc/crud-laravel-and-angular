<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
          [
            "name" => "Science fiction",
            "description" => "Science fiction description",
          ],
          [
              "name" => "Drama",
              "description" => "Drama description",
          ],
        ];

        for ($i=0; $i < count($categories); $i++) {
          DB::table('categories')->insert($categories[$i]);
        }
    }
}
