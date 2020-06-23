<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Tenant;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) 
{
    return [
        //gera um novo tenant para criar um tenant_id
        'tenant_id' => factory(Tenant::class),
        //gera um nome único
        'name'      => $faker->unique()->name,
        //gera uma descricao
        'description'   => $faker->sentence,
    ];
});
