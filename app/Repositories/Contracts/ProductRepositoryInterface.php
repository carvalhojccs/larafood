<?php

namespace App\Repositories\Contracts;

/**
 *
 * @author carvalhojccs
 */
interface ProductRepositoryInterface 
{
    public function getProductsByTenantId(int $tenantId, array $categories);
    public function getProductByUuid(string $uuid);
}
