<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreOrder;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    protected $orderService;
    
    public function __construct(OrderService $orderService) 
    {
        $this->orderService = $orderService;
    }
    
    public function store(StoreOrder $request) 
    {
        $order = $this->orderService->createNewOrder($request->all());
        
        return new OrderResource($order);
    }
    
    public function show($identify) 
    {
        if($order = $this->orderService->getOrderByIdentify($identify)):
            return new OrderResource($order);
        else:
            return response()->json(['message' => 'Not found!'],404);
        endif;
    }
    
    public function myOrders() 
    {
        $orders = $this->orderService->ordersByClient();
        
        return OrderResource::collection($orders);
    }
    
    
}
