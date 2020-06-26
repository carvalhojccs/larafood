<?php

namespace App\Repositories\Contracts;

/**
 *
 * @author carvalhojccs
 */
interface TenantRepositoryInterface 
{
    public function getAllTenants(int $per_page);
    public function getTenantByUuid(string $uuid);
}

