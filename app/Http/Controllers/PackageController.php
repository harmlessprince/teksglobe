<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePackage;
use App\Models\Package;
use App\Models\Plan;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('user.package.index', compact('packages'));
    }

    /**
     * Display a listing of the packages for the admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminIndex()
    {
        $packages = Package::all();
        return view('admin.package.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePackage $request)
    {
        //
        [
            'name' => $name,
            'amount' => $amount,
            'interest' => $interest,
            'status' => $status,
        ] = $request->validated();
        Package::create([
            'name' => $name,
            'amount' => $amount,
            'interest' => $interest,
            'status' => $status,
        ]);
        return back()->with('success', 'Package Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return view('user.package.show', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        if ($package->investments()->exists()) {
            return back()->with('error', 'Ooops!! This Package can not be deleted, their are users subscribed to it');
        }
        $package->delete();
        return back()->with('success', 'Package has been Deleted');
    }
}
