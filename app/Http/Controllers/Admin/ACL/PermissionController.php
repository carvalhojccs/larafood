<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;
use App\Models\ACL\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $repository, $model;
    
    public function __construct(Permission $repository, Request $request) 
    {
        $this->repository = $repository;
        $this->model = $request->segment(2);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera os dados da tabela
        $data = $this->repository->paginate();
        
        //chama a view index localizada na pasta 
        //resourses/view/admin/acl/permissions/index.blade.php e passa os dados no objeto $data
        return view('admin.acl.'.$this->model.'.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //chama a view create, com o formulário para inserção de dados, localizada na pasta 
        //resourses/view/admin/acl/permissions/create.blade.php
        return view('admin.acl.'.$this->model.'.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUpdatePermission  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePermission $request)
    {
        $this->repository->create($request->all());
        
        return redirect()->route($this->model.'.index')->with('success', 'Cadastro realizado com sucesso!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //recupera o registro pelo seu id
        $data = $this->repository->find($id);
        
        //chama a view show localizada na pasta 
        //resources/view/admin/acl/permissions/show.blade.php passando os dados no array $data
        return view('admin.acl.'.$this->model.'.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
   {
        //recupera o registro pelo seu id
        $data = $this->repository->find($id);
        
        //chama a view edit localizada na pasta
        //resources/view/admin/acl/permissions/edit.blade.php
        return view('admin.acl.'.$this->model.'.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreUpdatePermission  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePermission $request, $id)
   {
        $data = $this->repository->find($id);
        if($data):
            $data->update($request->all());
            return redirect()->route($this->model.'.index')
                    ->with('success', 'Registro atualizado com sucesso!');
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
        $data = $this->repository->find($id);
        if($data):
            $data->delete();
            return redirect()->route($this->model.'.index')
                        ->with('successDelete', 'O perfil '.$data->name.' foi deletado com sucesso!');
        else:
            return redirect()->back();
        endif;
    }
    
     /*
     * Search results
     * 
     * @param Request $request
     * @return \Illiminate\Http\Response
     */
    public function search(Request $request) 
    {
        $filters = $request->only('filters');
        $data = $this->repository
                            ->where(function($query) use($request){
                                if($request->filter):
                                    $query->where('name',$request->filter)
                                          ->orWhere('description','like',"%$request->filter%");
                                endif;
                                
                            })->paginate();
        return view('admin.acl.permissions.index', compact('data','filters'));
    }
}
