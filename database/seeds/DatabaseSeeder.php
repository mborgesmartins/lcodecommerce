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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

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
        foreach ($tables as $table) {
            $this->command->info('Truncating table ' . $table);
            DB::statement('TRUNCATE TABLE ' . $table .';');
            //DB::table($table)->truncate();
        }

// Call all the seeders

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        // $this->call(UserTableSeeder::class);

        $this->call('CategoryTableSeeder');
        $this->call('ProductTableSeeder');
        $this->call('UserTableSeeder');

    }
}
