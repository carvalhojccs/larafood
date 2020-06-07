<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenant;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    protected $repository;
    
    public function __construct(Tenant $tenant)
    {
        $this->repository = $tenant;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera todos os tenants
        $data = $this->repository->paginate();
        
        /*
         * retorna a view index.blade.php localizada na pasta
         * resources/views/admin/pages/tenants
         */
        return view('admin.pages.tenants.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
         * retorna a view create.blade.php localizada na pasta
         * resources/views/admin/pages/tenants
         */
        return view('admin.pages.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateTenant  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTenant $request)
    {
        $data = $request->all();
        
        $tenant = auth()->user()->tenant;
        
        if($request->hasFile('image') && $request->image->isValid()):
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/logo");
            $this->repository->create($data);

            return redirect()->route('tenants.index')->withSuccess('message');
        else:
            return redirect()->back();
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($data = $this->repository->find($id)):
            return view('admin.pages.tenants.show', compact('data'));
        else:
            return redirect()->back();
        endif;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($data = $this->repository->find($id)):
            return view('admin.pages.tenants.edit', compact('data'));
        else:
            return redirect()->back();
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateTenant  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenant $request, $id)
    {
        if($product = $this->repository->find($id)):
            $data = $request->all();
            $tenant = auth()->user()->tenant;    
            
            if($request->hasFile('image') && $request->image->isValid()):
                if(Storage::exists($tenant->logo)):
                    Storage::delete($tenant->logo);
                endif;
                $data['image'] = $request->image->store("tenants/{$tenant->uuid}/logo");
            endif;

            $product->update($data);
        
            return redirect()->route('tenants.index')->withSuccess('message');
        else:
            return redirect()->back();
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($data = $this->reposiroty->find($id)):
            if(Storage::exists($tenant->logo)):
                Storage::delete($tenant->logo);
            endif;
            
            $data->delete();
            return redirect()->route('tenants.index')->withSuccess('message');
        else:
            return redirect()->back();
        endif;
    }
    
    /*
     * Show search results
     * 
     * @param 
     */
    public function search(Request $request) 
    {
        $filters = $request->except('_token');
        
        $data = $this->reposiroty->latest()->tenantUser()->search($filters);
        
        return view('admin.pages.tenants.index', compact('filters','data'));
    }
}
