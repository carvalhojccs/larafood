<?php

namespace App\Repositories\Contracts;

/**
 *
 * @author carvalhojccs
 */
interface EvaluationRepositoryInterface 
{
    public function newEvaluationOrder(int $orderId, int $clientId, array $evaluation); 
    public function getEvaluationsByOrder(int $orderId); 
    public function getEvaluationsByClient(int $clientId); 
    public function getEvaluationsById(int $id); 
    public function getEvaluationsByClientIdOrderId(int $orderId, int $clientId); 
}
