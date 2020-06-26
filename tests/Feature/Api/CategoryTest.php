<?php

namespace Tests\Feature\Api;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Error get categories by tenant
     * Endpoint: /categories.
     *
     * @return void
     */
    public function testGetAllCategoriesTenantError()
    {
        $response = $this->getJson('/api/v1/categories');
        
        //$response->dump();

        $response->assertStatus(422);
    }
    
    /**
     * Get categories by tenant
     * Endpoint: /categories
     * @token_company = uuid do tenant
     *
     * @return void
     */
    public function testGetAllCategoriesByTenan()
    {
        //cria um tenant
        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/v1/categories?token_company={$tenant->uuid}");
        
        //$response->dump();

        $response->assertStatus(200);
    }
    
    /**
     * Error get category by tenant
     * Endpoint: /categories/{identify}
     * @token_company = uuid do tenant
     *
     * @return void
     */
    public function testErrorGetCategoryByTenan()
    {
        //atribui um valor fake à variável category
        $category = 'fake_value';
        
        //cria um tenant
        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/v1/categories/{$category}?token_company={$tenant->uuid}");
        
        //$response->dump();

        $response->assertStatus(404);
    }
    
    /**
     * Get category by tenant
     * Endpoint: /categories/{identify}
     * @token_company = uuid do tenant
     *
     * @return void
     */
    public function testGetCategoryByTenan()
    {
        //cria uma category
        $category = factory(\App\Models\Category::class)->create();
        
        //cria um tenant
        $tenant = factory(Tenant::class)->create();
        
        $response = $this->getJson("/api/v1/categories/{$category->uuid}?token_company={$tenant->uuid}");
        
        //$response->dump();

        $response->assertStatus(200);
    }
}
