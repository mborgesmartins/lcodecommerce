<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //DB::table('users')->truncate();

        factory('CodeCommerce\User',1)->create([

            'name' => 'Administrator',
            'email' => 'admin@servidor.com',
            'password' => bcrypt('123456'),
            'remember_token' => '123456',
            'is_admin' => true

    ]);

        factory('CodeCommerce\User',10)->create();
    }
}
