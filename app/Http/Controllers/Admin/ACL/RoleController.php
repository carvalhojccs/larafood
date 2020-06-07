<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;
use App\Models\ACL\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $repository;
    
    public function __construct(Role $role) 
    {
        $this->repository = $role;
        $this->middleware(['can:roles']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->repository->paginate();
        
        return view('admin.pages.roles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateRole  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRole $request)
    {
        $this->repository->create($request->all());
        
        return redirect()->route('roles.index')->withSuccess('message');
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
            return view('admin.pages.roles.show', compact('data'));
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
            return view('admin.pages.roles.edit', compact('data'));
        else:
            return redirect()->back();
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateRole  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($data = $this->repository->find($id)):
            $data->update($request->all());
            return redirect()->route('roles.index')->withSuccess('message');
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
            return redirect()->route('roles.index')->withSuccess('message');
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
        
        $data = $this->repository->search($filters);
        
        return view('admin.pages.roles.index', compact('filters','data'));
    }
}
