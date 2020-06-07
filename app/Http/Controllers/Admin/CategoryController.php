<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $repository;
    
    public function __construct(Category $category) 
    {
        $this->repository = $category;
        
        $this->middleware(['can:categories']);

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera todas as categorias
        $data = $this->repository->paginate();
        
        /*
         * retorna a view index.blade.php localizada na pasta
         * resourses\views\admin\pages\categories
         * e passa as catagorias no array $data
         */
        return view('admin.pages.categories.index', compact('data'));
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
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategory $request)
    {
        $this->repository->create($request->all());
        
        return redirect()->route('categories.index')->withSuccess('message');
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
            return view('admin.pages.categories.show', compact('data'));
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
            return view('admin.pages.categories.edit', compact('data'));
        else:
            return redirect()->back();
        endif;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategory $request, $id)
    {
        if($data = $this->repository->find($id)):
            $data->update($request->all());
            return redirect()->route('categories.index')->withSuccess('message');
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
            return redirect()->route('categories.index')->withSuccess('message');
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
        
        return view('admin.pages.categories.index', compact('filters','data'));
    }
}
