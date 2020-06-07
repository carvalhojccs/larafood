<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;

class SiteController extends Controller
{
    public function index() 
    {
        $plans = Plan::with('details')->orderBy('price','ASC')->get();
        
        return view('site.pages.home.index', compact('plans'));
    }
    
    public function plan($url) 
    {   
        //recupera o plano pela sua url
        if($plan = Plan::where('url',$url)->first()):
            //cria uma seção como nome plan e insere o objeto $plan nela
            session()->put('plan',$plan);
            //redireciona  para a rota de registro
            return redirect()->route('register');
        else:
            //se não encontrar o plano, volta para a  página anterior
            redirect()->back();
        endif;
    }
}
