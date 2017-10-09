<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Category;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = Category::all();

      foreach($categories as $category) {
        DB::table('books')->insert([
          "name" => "Book name of category ".$category->name,
          "description" => "Book description of category ".$category->name,
          "author" => "Author ".$category->name,
          "published_date" => new DateTime(),
          "user" => "username ".$category->name,
          "category_id" => $category->id,
          "available" => true
        ]);
      }
    }
}
