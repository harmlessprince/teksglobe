<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlan;
use App\Models\Plan;
use App\Models\Style;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plans = Plan::with('style')->get();
        return view('admin.plan.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $styles = Style::get();
        return view('admin.plan.create', compact('styles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePlan $request)
    {
        //
        [
            'plan_name' => $name,
            'style_id' => $style_id,
            'minimum' => $minimum,
            'maximum' => $maximum,
            'percentage' => $percentage,
            'repeat' => $repeat,
            'start_duration' => $start_duration,
            'status' => $status,
        ] = $request->validated();
        Plan::create([
            'plan_name' => $name,
            'style_id' => $style_id,
            'minimum' => $minimum,
            'maximum' => $maximum,
            'percentage' => $percentage,
            'repeat' => $repeat,
            'start_duration' => $start_duration,
            'status' => $status,
        ]);
        return back()->with('success', 'Investment Plan Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
