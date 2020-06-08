<?php

namespace App\Repositories\Contracts;

/**
 *
 * @author carvalhojccs
 */
interface CategoryRepositoryInterface 
{
    public function getCategoriesByTenantUuid(string $uuid);
    public function getCategoriesByTenantId(int $tenantId);
    public function getCategotyByUrl(string $url);
}
