<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Plan;

class PlansController extends AdminController
{
    public function index()
    {
    	$plans = Plan::orderByDesc('period_days')->paginate(10);
    	return view('admin.plans.index', ['plans' => $plans]);
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $plan = new Plan();
        $plan->name = $request->name;
       	$plan->price_cents = $request->price_cents;
       	$plan->period_days = $request->period_days;
       	$plan->trial_days = $request->trial_days;
    	$plan->save();

        if(isset($request->tags))
        {
            $plan->tag($request->tags);
        }

        return view('admin.plans.edit', ['plan' => $plan]);
    }

    public function edit($id)
    {
        $plan = Plan::find($id);
        return view('admin.plans.edit', ['plan' => $plan]);
    }

    public function update($id, Request $request)
    {
        $plan = Plan::find($id);
        $plan->name = $request->name;
       	$plan->price_cents = $request->price_cents;
       	$plan->period_days = $request->period_days;
       	$plan->trial_days = $request->trial_days;
        
        if(isset($request->tags))
        {
            $plan->tag($request->tags);
        }

    	$plan->save();

        return view('admin.plans.edit', ['plan' => $plan]);
    }

    public function untag($id, $tag, Request $request)
    {
        $plan = Plan::find($id);
        $plan->untag($tag);

        return view('admin.plans.edit', ['plan' => $plan]);
    }

    public function destroy($id)
    {
        Plan::destroy($id);

        return redirect(route('admin.plans.index'));
    }
}
