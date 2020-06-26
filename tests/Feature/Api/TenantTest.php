<?php

namespace Tests\Feature\Api;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
    /**
     * Test get all tenants.
     * Endpoint: /tenants
     * 
     * @return void
     */
    public function testGetAllTenants()
    {
        //cria 10 tenants
        factory(Tenant::class, 10)->create();
        
        $response = $this->getJson('/api/v1/tenants');
        
       // $response->dump();

        $response->assertStatus(200);
        
        //verifica se foram criados 10 tenants
        $response->assertJsonCount(10,'data');
    }
    
    /**
     * Test get error single tenant.
     * Endpoint: /tenants/{uuid}
     *
     * @return void
     */
    public function testErrorGetTenant()
    {
        //cria um tenant fake
        $tenant = "fake_value";
        
        $response = $this->getJson("/api/v1/tenants/{$tenant}");
        
        //$response->dump();
        
        $response->assertStatus(404);
    }
    
    /**
     * Test get tenant by uuid.
     * Endpoint: /tenants/{uuid}
     *
     * @return void
     */
    public function testGetTenantByIdentify()
    {
        //cria um tenant
        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/v1/tenants/{$tenant->uuid}");
        
        //$response->dump();
        
        $response->assertStatus(200);
    }
}
