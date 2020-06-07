<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $repository;
    
    public function __construct(Plan $plan) 
    {
        $this->repository = $plan;
        
        $this->middleware(['can:plans']);
    }
    
    public function index()
    {
        $data = $this->repository->latest()->paginate();
        return view('admin.pages.plans.index', compact('data'));
    }
    public function create()
    {
        return view('admin.pages.plans.create');
    }
    
    public function store(StoreUpdatePlan $request) 
    {
        $this->repository->create($request->all());
        
        return redirect()->route('plans.index');
    }
    
    public function show($url) 
    {
        $data = $this->repository->where('url',$url)->first();
        
        if($data):
            return view('admin.pages.plans.show', compact('data'));
        else:
            return redirect()->back();
        endif;
    }
    
    public function destroy($url) 
    {
        $data = $this->repository
                     ->with('details') 
                     ->where('url',$url)->first();
        
        if($data):
            if($data->details->count() > 0):
                return redirect()
                    ->back()
                    ->with('error',"Existe(em) {$data->details->count()} detalhe(es) vinculado(os) a este plano, portanto não pode ser deletado!");
            endif;
            $data->delete();
            return redirect()->route('plans.index');
        else:
            return redirect()->back();
        endif;
    }
    
    public function edit($url)
    {
        $data = $this->repository->where('url',$url)->first();
        
        if($data):
            return view('admin.pages.plans.edit', compact('data'));
        else:
            return redirect()->back();
        endif;
    }
    
    public function update(StoreUpdatePlan $request, $url) 
    {
        $data = $this->repository->where('url',$url)->first();
        
        if($data):
            $data->update($request->all());
            return redirect()->route('plans.index');
        else:
            return redirect()->back();
        endif;
    }
    
    public function search(Request $request) 
    {
        $filters = $request->except('_token');
        $data = $this->repository->search($request->filter);
        
        return view('admin.pages.plans.index', compact('data','filters'));
    }
}
