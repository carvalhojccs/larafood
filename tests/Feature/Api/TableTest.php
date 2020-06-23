<?php

namespace Tests\Feature\Api;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Error get tables by tenant
     * Endpoint: /tables.
     *
     * @return void
     */
    public function testGetAllTablesTenantError()
    {
        $response = $this->getJson('/api/v1/tables');
        
        //$response->dump();

        $response->assertStatus(422);
    }
    
    /**
     * Get tables by tenant
     * Endpoint: /tables
     * @token_company = uuid do tenant
     *
     * @return void
     */
    public function testGetAllTablesByTenant()
    {
        //cria um tenant
        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");
        
        //$response->dump();

        $response->assertStatus(200);
    }
    
    /**
     * Error get table by tenant
     * Endpoint: /tables/{identify}
     * @token_company = uuid do tenant
     *
     * @return void
     */
    public function testErrorGetTableByTenan()
    {
        //atribui um valor fake à variável table
        $table = 'fake_value';
        
        //cria um tenant
        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/v1/tables/{$table}?token_company={$tenant->uuid}");
        
        //$response->dump();

        $response->assertStatus(404);
    }
    
    /**
     * Get table by tenant
     * Endpoint: /tables/{identify}
     * @token_company = uuid do tenant
     *
     * @return void
     */
    public function testGetTableByTenan()
    {
        //cria uma table
        $table = factory(Table::class)->create();
        
        //cria um tenant
        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/v1/tables/{$table->uuid}?token_company={$tenant->uuid}");
        
        //$response->dump();

        $response->assertStatus(200);
    }
}
