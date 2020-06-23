<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\Tenant;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) 
{
    return [
        //gera um novo tenant para criar um tenant_id
        'tenant_id' => factory(Tenant::class),
        //gera um título único
        'title'      => $faker->unique()->name,
        //gera uma descricao
        'description'   => $faker->sentence,
        //gera uma imagem padrão
        'image'     => 'pizza.png',
        'price'     => 12.9,
    ];
});
