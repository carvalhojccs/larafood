<?php

namespace App\Services;

use App\Repositories\Contracts\EvaluationRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;

/**
 * Description of EvaluationService
 *
 * @author carvalhojccs
 */
class EvaluationService 
{
    protected $evaluationRepository, $orderRepository;
    
    public function __construct(EvaluationRepositoryInterface $evaluation, OrderRepositoryInterface $order) 
    {
        $this->evaluationRepository = $evaluation;
        $this->orderRepository = $order;
    }
    
    public function createNewEvaluation(string $identifyOrder, array $evaluation) 
    {
        
        $clientId = $this->getClientId();
        
        $order = $this->orderRepository->getOrderByIdentify($identifyOrder);
        
        return $this->evaluationRepository->newEvaluationOrder($order->id, $clientId, $evaluation);
    }
    
    private function getClientId() 
    {
        return auth()->user()->id;
    }
}
