<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) 
{
    return [
        //gera um novo tenant para criar um tenant_id
        'tenant_id' => factory(Tenant::class),
        //gera um identificador único
        'identify'  => uniqid().Str::random(10),
        //gera um total fixo
        'total' => 80.0,
        'status'    => 'open',
    ];
});
