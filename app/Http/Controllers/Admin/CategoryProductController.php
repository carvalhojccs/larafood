<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $category, $product;
    
    public function __construct(Category $category, Product $product) 
    {
        $this->category = $category;
        $this->product = $product;
    }
    
    public function categories($product_id) 
    {
        $product = $this->product->find($product_id);
        
        if($product):
            $categories = $product->categories()->paginate();
            return view('admin.pages.products.categories.categories', compact('product','categories'));
        else:
            return redirect()->back();
        endif;
    }
    
     public function products($idCategory)
    {
        if (!$category = $this->category->find($idCategory)) {
            return redirect()->back();
        }

        $products = $category->products()->paginate();

        return view('admin.pages.categories.products.products', compact('category', 'products'));
    }

    
    public function categoriesAvailable(Request $request,$product_id) 
    {
        if($product = $this->product->find($product_id)):
            $filters = $request->except('_token');
            $categories = $product->categoriesAvailable($request->filter);
            return view('admin.pages.products.categories.available', compact('product','categories','filters'));
        else:
            return redirect()->back();
        endif;
    }
    
     public function attachCategoriesProduct(Request $request, $idProduct)
    {
        if (!$product = $this->product->find($idProduct)) {
            return redirect()->back();
        }

        if (!$request->categories || count($request->categories) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $product->categories()->attach($request->categories);

        return redirect()->route('products.categories', $product->id);
    }
    
    public function detachCategoryProduct($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if (!$product || !$category) {
            return redirect()->back();
        }

        $product->categories()->detach($category);

        return redirect()->route('products.categories', $product->id);
    }
}
