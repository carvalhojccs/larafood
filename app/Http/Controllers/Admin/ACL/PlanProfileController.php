<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\ACL\Profile;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    protected $plan, $profile;
    
    public function __construct(Plan $plan, Profile $profile) 
    {
        $this->plan     = $plan;
        $this->profile  = $profile;
    }

    public function profiles($planId) 
    {
      if($plan = $this->plan->find($planId)):          
          $profiles = $plan->profiles()->paginate();
          return view('admin.acl.plans.profiles.profiles', compact('plan','profiles'));
        else:
            redirect()->back();
      endif;
    }
    
    public function plans($profileId) 
    {
        if($profile = $this->profile->find($profileId)):
            $plans = $profile->plans()->paginate();
            return view('admin.acl.profiles.plans.plans', compact('profile','plans'));
        else:
            redirect()->back();
        endif;
    }
    
    public function profilesAvailable(Request $request, $planId) 
    {
        if($plan = $this->plan->find($planId)):
            $filters = $request->except('_token');
            $profiles = $plan->profilesAvailable($request->filter);
            return view('admin.acl.plans.profiles.available', compact('plan','profiles','filters'));
        endif;
    }
    
    public function attachPlansProfile(Request $request, $planId) 
    {
        //dd('vincular');
        
        if($plan = $this->plan->find($planId)):
            if(!$request->profiles || count($request->profiles) == 0):
                return redirect()->back()->with('info','Seleciona pelo menos um perfil!');
            else:
                $plan->profiles()->attach($request->profiles);
                return redirect()->route('plans.profiles', $plan->id);
            endif;
        else:
            redirect()->back();
        endif;
    }
    
    public function detachPlanProfile($planId, $profileId) 
    {
        $plan = $this->plan->find($planId);
        $profile = $this->profile->find($profileId);
        
        if($plan || $profile):
            $plan->profiles()->detach($profile);
            return redirect()->route('plans.profiles', $plan->id);
            else:
            return redirect()->back();
        endif;
    }
}
