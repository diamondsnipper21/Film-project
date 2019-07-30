<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductPlan;

class ProductPlansController extends AdminController
{
    public function index()
    {
    	$plans = ProductPlan::orderByDesc('period_days')->paginate(10);
    	return view('admin.product_plans.index', ['plans' => $plans]);
    }

    public function create()
    {
        return view('admin.product_plans.create');
    }

    public function store(Request $request)
    {
        $plan = new ProductPlan();
        $plan->name = $request->name;
       	$plan->price_cents = $request->price_cents;
       	$plan->period_days = $request->period_days;
       	$plan->trial_days = $request->trial_days;
    	$plan->save();

        if(isset($request->tags))
        {
            $plan->tag($request->tags);
        }

        return view('admin.product_plans.edit', ['plan' => $plan]);
    }

    public function edit($id)
    {
        $plan = ProductPlan::find($id);
        return view('admin.product_plans.edit', ['plan' => $plan]);
    }

    public function update($id, Request $request)
    {
        $plan = ProductPlan::find($id);
        $plan->name = $request->name;
       	$plan->price_cents = $request->price_cents;
       	$plan->period_days = $request->period_days;
       	$plan->trial_days = $request->trial_days;
        
        if(isset($request->tags))
        {
            $plan->tag($request->tags);
        }

    	$plan->save();

        return view('admin.product_plans.edit', ['plan' => $plan]);
    }

    public function untag($id, $tag, Request $request)
    {
        $plan = ProductPlan::find($id);
        $plan->untag($tag);

        return view('admin.product_plans.edit', ['plan' => $plan]);
    }

    public function destroy($id)
    {
        ProductPlan::destroy($id);

        return redirect(route('admin.product_plans.index'));
    }
}
