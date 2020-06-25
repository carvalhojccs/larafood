<?php

namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\Contracts\EvaluationRepositoryInterface;

/**
 * Description of EvaluationRepository
 *
 * @author carvalhojccs
 */
class EvaluationRepository implements EvaluationRepositoryInterface
{
    protected $entity;
    
    public function __construct(Evaluation $evaluation) 
    {
        $this->entity = $evaluation;
    }
    
    public function newEvaluationOrder(int $orderId, int $clientId, array $evaluation) 
    {
        $data = [
            'client_id'     => $clientId,
            'order_id'      => $orderId,
            'stars'         => $evaluation['stars'],
            'comment'       => isset($evaluation['comment']) ? $evaluation['comment'] : '',
        ];
        
        return $this->entity->create($data);
    }

    public function getEvaluationsByClient(int $clientId) 
    {
        return $this->entity->where('client_id',$clientId)->get();
    }

    public function getEvaluationsByOrder(int $orderId) 
    {
        return $this->entity->where('order_id',$orderId)->get();
    }

    public function getEvaluationsById(int $id) 
    {
        return $this->entity->find($id);
    }

    public function getEvaluationsByClientIdOrderId(int $orderId, int $clientId) 
    {
        return $this->entity->where('client_id', $clientId)->where('order_id', $orderId)->first();
    }

}
