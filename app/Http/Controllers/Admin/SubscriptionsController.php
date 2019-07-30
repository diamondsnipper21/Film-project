<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionsController extends AdminController
{
    public function index()
    {
    	$subscriptions = Subscription::orderByDesc('created_at', 'desc')->paginate(10);
    	return view('admin.subscriptions.index', ['subscriptions' => $subscriptions]);
    }
}
