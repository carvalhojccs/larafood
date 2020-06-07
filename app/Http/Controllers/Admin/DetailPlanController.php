<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    protected $repository, $planRepository;
    
    public function __construct(DetailPlan $detailPlan, Plan $plan) 
    {
        $this->repository       = $detailPlan;
        $this->planRepository   = $plan;
    }
    
    public function index($urlPlan) 
    {
        if($plan = $this->planRepository->where('url',$urlPlan)->first()):
            $details = $plan->details()->paginate();
            return view('admin.pages.plans.details.index', compact('plan','details'));
        else:
            return redirect()->back();
        endif;
    }
    public function create($urlPlan) 
    {
        if($plan = $this->planRepository->where('url',$urlPlan)->first()):
            return view('admin.pages.plans.details.create', compact('plan'));
        else:
            return redirect()->back();
        endif;
    }
    
    public function store(StoreUpdateDetailPlan $request, $urlPlan) 
    {
        if($plan = $this->planRepository->where('url',$urlPlan)->first()):
            $plan->details()->create($request->all());
            return redirect()->route('details.plan.index',$plan->url);
        else:
            return redirect()->back();
        endif;
    }
    
    public function edit($detailId, $urlPlan) 
    {
        $plan   = $this->planRepository->where('url',$urlPlan)->first();
        $detail = $this->repository->find($detailId);
        
        if($plan || $detail):
            return view('admin.pages.plans.details.edit', compact('plan','detail'));
        else:
            return redirect()->back();
        endif;
    }
    
    public function update(StoreUpdateDetailPlan $request, $detailId, $urlPlan) 
    {
        $plan   = $this->planRepository->where('url',$urlPlan)->first();
        $detail = $this->repository->find($detailId);
        
        if($plan || $detail):
            $detail->update($request->all());
            return redirect()->route('details.plan.index',$plan->url);
        else:
            return redirect()->back();
        endif;
    }
    
    public function show($detailId, $urlPlan) 
    {
        $plan   = $this->planRepository->where('url',$urlPlan)->first();
        $detail = $this->repository->find($detailId);
        
        if($plan || $detail):
            return view('admin.pages.plans.details.show', compact('plan','detail'));
        else:
            return redirect()->back();
        endif;
    }
    
    public function destroy($detailId, $urlPlan) 
    {
        $plan   = $this->planRepository->where('url',$urlPlan)->first();
        $detail = $this->repository->find($detailId);
        
        if($plan || $detail):
            $detail->delete();
            return redirect()
                    ->route('details.plan.index',$plan->url)
                    ->with('message', 'Operação realizada com sucesso!');
        else:
            return redirect()->back();
        endif;
    }
   
}
