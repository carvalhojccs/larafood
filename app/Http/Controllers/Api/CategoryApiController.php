<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $categoryService;
    
    public function __construct(CategoryService $categoryService) 
    {
        $this->categoryService = $categoryService;
    }
    
    public function categoriesByTenant(TenantFormRequest $request) 
    {
        if($request->token_company):
            return CategoryResource::collection($this->categoryService->getCategoriesByUuid($request->token_company));
        else:
            return response()->json(['message','Token not found'],404);
        endif;
    }
    
    public function show(TenantFormRequest $request, $url) 
    {
        if($category = $this->categoryService->getCategoryByUrl($url)):
            return new CategoryResource($category); 
        else:
            return response()->json(['message','Category not found'],404);
        endif;
    }
}
