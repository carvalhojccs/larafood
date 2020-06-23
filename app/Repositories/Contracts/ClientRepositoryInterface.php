<?php

namespace App\Repositories\Contracts;

/**
 *
 * @author carvalhojccs
 */
interface ClientRepositoryInterface 
{
    public function createNewClient(array $data); 
    public function getClient(int $id);
}
