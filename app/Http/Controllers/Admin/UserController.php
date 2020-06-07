<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $reposiroty, $model;
    
    public function __construct(User $user, Request $request) 
    {
        $this->reposiroty = $user;
        $this->model = $request->segment(2);
        
        $this->middleware(['can:users']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->reposiroty->latest()->tenantUser()->paginate();
        
        return view('admin.pages.'.$this->model.'.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {
        $data = $request->all();
        $data['tenant_id'] = auth()->user()->tenant_id;
        $data['password'] = bcrypt($data['password']);
        
        $this->reposiroty->create($data);
        
        return redirect()->route('users.index')->withSuccess('message');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($data = $this->reposiroty->tenantUser()->find($id)):
            return view('admin.pages.users.show', compact('data'));
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
        if($data = $this->reposiroty->tenantUser()->find($id)):
            return view('admin.pages.users.edit', compact('data'));
        else:
            return redirect()->back();
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $id)
    {
        if($user = $this->reposiroty->tenantUser()->find($id)):
             $data = $request->only(['name','email']);
        
             if($request->password):
                 $data['password'] = bcrypt($request->password);
             endif;
            
            $user->update($data);
            return redirect()->route('users.index')->withSuccess('message');
        else:
            
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
        if($data = $this->reposiroty->tenantUser()->find($id)):
            $data->delete();
            return redirect()->route('users.index')->withSuccess('message');
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
        
       
        
        return view('admin.pages.users.index', compact('filters','data'));
    }
}
