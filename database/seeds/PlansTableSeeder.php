<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name'          => 'Free',
            'url'           => 'free',
            'price'         => 00.00,
            'description'   => 'Plano Gratuito',
        ]);
        Plan::create([
            'name'          => 'Premium',
            'url'           => 'premium',
            'price'         => 299.99,
            'description'   => 'Plano Premium',
        ]);
        Plan::create([
            'name'          => 'Business',
            'url'           => 'business',
            'price'         => 499.99,
            'description'   => 'Plano Empresarial',
        ]);
    }
}
