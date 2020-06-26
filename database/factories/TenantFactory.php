<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Plan;
use App\Models\Tenant;
use Faker\Generator as Faker;

$factory->define(Tenant::class, function (Faker $faker) 
{
    return [
        //cria um plano
        'plan_id'   => factory(Plan::class),
        //gera o cnpj
        'cnpj'      => uniqid().date('YmdHis'),
        //gera o nome da empresa
        'name' => $faker->unique()->name,
        //gera o email do usuário
        'email' => $faker->unique()->safeEmail,
    ];
});
