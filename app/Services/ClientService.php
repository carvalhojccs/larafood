<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;

/**
 * Description of ClientService
 *
 * @author carvalhojccs
 */
class ClientService 
{
    protected $clientRepository;
    
    public function __construct(ClientRepositoryInterface $clientrepository)
    {
        $this->clientRepository = $clientrepository;
    }
    
    public function createNewClient(array $data) 
    {
        return $this->clientRepository->createNewClient($data);
    }
            
}
