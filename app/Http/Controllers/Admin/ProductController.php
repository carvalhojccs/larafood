<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function view;

class ProductController extends Controller
{
    protected $repository;
    
    public function __construct(Product $product) 
    {
        $this->repository = $product;
        
        $this->middleware(['can:products']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //recupera todos os produtos
        $data = $this->repository->paginate();
        /*
         * retorna a view index.blade.php localizada na pasta
         * resources/views/admin/pages/products
         */
        return view('admin.pages.products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $data = $request->all();
        
        $tenant = auth()->user()->tenant;
        
        if($request->hasFile('image') && $request->image->isValid()):
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
            $this->repository->create($data);

            return redirect()->route('products.index')->withSuccess('message');
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
            return view('admin.pages.products.show', compact('data'));
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
            return view('admin.pages.products.edit', compact('data'));
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
    public function update(StoreUpdateProduct $request, $id)
    {
        if($product = $this->repository->find($id)):
            $data = $request->all();
            $tenant = auth()->user()->tenant;    
            
            if($request->hasFile('image') && $request->image->isValid()):
                if(Storage::exists($product->image)):
                    Storage::delete($product->image);
                endif;
                
                $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
                
                
            endif;
            
            
            $product->update($data);
        
            return redirect()->route('products.index')->withSuccess('message');
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
            if(Storage::exists($product->image)):
                Storage::delete($product->image);
            endif;
            
            $data->delete();
            return redirect()->route('products.index')->withSuccess('message');
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
        
        return view('admin.pages.products.index', compact('filters','data'));
    }
}
