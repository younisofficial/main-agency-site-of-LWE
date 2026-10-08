<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;

class PricingController extends Controller
{
    public function index()
    {
        return PricingPlan::orderBy('sort_order')->get();
    }
}
