<?php

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenants = Tenant::first();
        
        $tenants->users()->create([
            'name'  => 'Administrador',
            'email' => 'admin@fab.mil.br',
            'password'  => bcrypt('123456'),
        ]);
    }
}
