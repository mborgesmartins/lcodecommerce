<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //DB::table('categories')->truncate();

        factory('CodeCommerce\Category',15)->create();
    }
}
