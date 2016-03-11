<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(CodeCommerce\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'end_logradouro' => $faker->streetName,
        'end_numero' => $faker->streetAddress,
        'end_complemento' => $faker->streetSuffix,
        'end_bairro' => $faker->name,
        'end_cidade' => "Rio de Janeiro",
        'end_uf' => "RJ",
        'end_cep' => $faker->postcode,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'is_admin' => false
    ];
});

$factory->define(CodeCommerce\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->sentence(),
    ];
});

$factory->define(CodeCommerce\Product::class, function (Faker\Generator $faker) {
    return [

        'category_id' => $faker->numberBetween(1,15),
        'name' => $faker->name(),
        'description' => $faker->sentence(),
        'price' => $faker->randomNumber(2),
        'featured' => $faker->boolean(false),
        'recommended' => $faker->boolean(false),
    ];
});
