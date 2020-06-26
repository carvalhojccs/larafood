<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTable;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    protected $repository, $model;
    
    public function __construct(Table $table, Request $request) 
    {
        $this->repository = $table;
        $this->model = $request->segment(2);
        
        $this->middleware(['can:tables']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera todas as tables
        $data = $this->repository->paginate();
        
        /*
         * retorna a view index.blade.php localizada na pasta
         * resourses\views\admin\pages\tables
         * e passa as catagorias no array $data
         */
        return view('admin.pages.'.$this->model.'.index', compact('data'));
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
         * resourses\views\admin\pages\categories
         */
        return view('admin.pages.'.$this->model.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateTable  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTable $request)
    {
        
        $this->repository->create($request->all());
        
        return redirect()->route($this->model.'.index')->withSuccess('message');
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
            return view('admin.pages.'.$this->model.'.show', compact('data'));
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
            return view('admin.pages.'.$this->model.'.edit', compact('data'));
        else:
            return redirect()->back();
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateTable  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTable $request, $id)
    {
        if($data = $this->repository->find($id)):
            $data->update($request->all());
            return redirect()->route($this->model.'.index')->withSuccess('message');
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
        if($data = $this->repository->find($id)):
            $data->delete();
            return redirect()->route($this->model.'.index')->withSuccess('message');
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
        
        $data = $this->repository->latest()->tenantUser()->search($filters);
        
        return view('admin.pages.'.$this->model.'.index', compact('filters','data'));
    }
    
    /**
     * Generate QRCode
     *
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function qrcode($identify)
    {
        if($data = $this->repository->where('identify',$identify)->first()):
            //recupera o tenant do usuário autenticado
            $tenant = auth()->user()->tenant;
        
            //uri do cliente
            $uri = env('URI_CLIENT')."/{$tenant->uuid}/{$data->uuid}";
            
            return view('admin.pages.'.$this->model.'.qrcode', compact('uri'));
        else:
            return redirect()->back();
        endif;
        
        
        
        
    }
}
