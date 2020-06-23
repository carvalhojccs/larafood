<?php

namespace App\Repositories\Contracts;

/**
 *
 * @author carvalhojccs
 */
interface TableRepositoryInterface 
{
    public function getTablesByTenantUuid(string $uuid);
    public function getTablesByTenantId(int $idTenant);
    public function getTableByUuid(string $uuid);
}
