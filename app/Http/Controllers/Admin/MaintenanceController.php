<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaintenanceRequest;
use App\Models\Maintenance;
use Illuminate\Support\Facades\Gate;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('access', 'admin');

        $maintenances = Maintenance::paginate(10);

        return view('maintenances.index', compact('maintenances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MaintenanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaintenanceRequest $request)
    {
        Gate::authorize('access', 'admin');

        Maintenance::create($request->validated());

        return redirect()->route('maintenances.index');
    }

    /**
     * Show the form for editing the specified resource.maintenance
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintenance $maintenance)
    {
        Gate::authorize('access', 'admin');

        return view('maintenances.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MaintenanceRequest  $request
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function update(MaintenanceRequest $request, Maintenance $maintenance)
    {
        Gate::authorize('access', 'admin');

        $maintenance->update($request->validated());

        return redirect()->route('maintenances.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Maintenance  $maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintenance $maintenance)
    {
        Gate::authorize('access', 'admin');

        $maintenance->delete();

        return redirect()->route('maintenances.index');
    }
}
