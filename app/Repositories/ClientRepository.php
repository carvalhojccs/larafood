<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

/**
 * Description of ClientRepository
 *
 * @author carvalhojccs
 */
class ClientRepository implements ClientRepositoryInterface
{
    protected $entity;

    public function __construct(Client $client) 
    {
        $this->entity = $client;
    }
    
    public function createNewClient(array $data) 
    {
        $data['password'] = bcrypt($data['password']);
        
        return $this->entity->create($data);
    }

    public function getClient(int $id) 
    {
        
    }
}
