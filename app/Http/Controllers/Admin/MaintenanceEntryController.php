<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Models\MaintenanceEntry;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\MaintenanceEntryRequest;

class MaintenanceEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('access', 'admin');

        $maintenanceEntries = MaintenanceEntry::with('maintenance', 'employee')->paginate(10);
        $maintenances = Maintenance::all();
        $employees = User::whereHas('roles', function (Builder $query) {
            $query->where('slug', 'staff');
        })->get();

        return view('maintenances.entryIndex', compact('maintenanceEntries', 'employees', 'maintenances'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MaintenanceEntryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaintenanceEntryRequest $request)
    {
        Gate::authorize('access', 'admin');

        if ($request->employee_id != -1) {
            if (!Maintenance::where('id', $request->maintenance_id)->exists() || !User::where('id', $request->employee_id)->exists()) {
                return redirect()->route('maintenanceEntries.index')->withError(true);
            }
            MaintenanceEntry::create($request->validated());
        } else {
            if (!Maintenance::where('id', $request->maintenance_id)->exists()) {
                return redirect()->route('maintenanceEntries.index')->withError(true);
            }
            MaintenanceEntry::create($request->only('date', 'time', 'maintenance_id'));
        }
        return redirect()->route('maintenanceEntries.index');
    }


    /**
     * Show the form for editing the specified resource.maintenance
     *
     * @param  \App\Models\MaintenanceEntry  $maintenanceEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(MaintenanceEntry $maintenanceEntry)
    {
        Gate::authorize('access', 'admin');
        $maintenances = Maintenance::all();
        $employees = User::whereHas('roles', function (Builder $query) {
            $query->where('slug', 'staff');
        })->get();
        return view('maintenances.entryEdit', compact('maintenanceEntry', 'maintenances', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MaintenanceEntryRequest  $request
     * @param  \App\Models\MaintenanceEntry  $maintenanceEntry
     * @return \Illuminate\Http\Response
     */
    public function update(MaintenanceEntryRequest $request, MaintenanceEntry $maintenanceEntry)
    {
        Gate::authorize('access', 'admin');

        if ($request->employee != -1) {
            if (!Maintenance::where('id', $request->maintenance_id)->exists() || !User::where('id', $request->employee_id)->exists()) {
                return redirect()->route('maintenanceEntries.index')->withError(true);
            }
            $maintenanceEntry->update($request->validated() + ['perform' => $request->perform === 'on']);
        } else {
            if (!Maintenance::where('id', $request->maintenance_id)->exists()) {
                return redirect()->route('maintenanceEntries.index')->withError(true);
            }
            $maintenanceEntry->update($request->only('date', 'time', 'maintenance_id') + ['perform' => $request->perform === 'on']);
        }

        return redirect()->route('maintenanceEntries.index');
    }

    public function confirm(Request $request, MaintenanceEntry $maintenanceEntry)
    {
        Gate::authorize('access', 'staff');

        if ($maintenanceEntry->employee == null) {
            $maintenanceEntry->employee()->associate($request->user());
        }
        $maintenanceEntry->update([
            'perform' => true,
        ]);
        return redirect()->route('main');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaintenanceEntry  $maintenanceEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaintenanceEntry $maintenanceEntry)
    {
        Gate::authorize('access', 'admin');

        $maintenanceEntry->delete();

        return redirect()->route('maintenanceEntries.index');
    }
}
