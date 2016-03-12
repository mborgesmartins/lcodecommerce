<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->command->info('Unguarding models');
        Model::unguard();
        //DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $tables = [
            'product_tag',
            'productimages',
            'products',
            'tags',
            'order_items',
            'order',
            'categories',
            'users'
        ];

        $this->command->info('Truncating existing tables');
        //DB::statement('TRUNCATE TABLE ' . implode(',', $tables). ';');
        foreach ($tables as $table) {
            DB::statement('DELETE FROM "' . $table . '";');
        }

// Call all the seeders

        //DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // $this->call(UserTableSeeder::class);

        $this->call('CategoryTableSeeder');
        $this->call('ProductTableSeeder');
        $this->call('UserTableSeeder');

    }
}
