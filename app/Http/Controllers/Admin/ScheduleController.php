<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\Hall;
use App\Models\Entry;
use App\Models\Couple;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Services\EntryService;
use App\Services\CoupleService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\CoupleResource;
use Illuminate\Database\Eloquent\Builder;

class ScheduleController extends Controller
{
    private $coupleService;
    private $entryService;

    public function __construct(CoupleService $coupleService, EntryService $entryService)
    {
        $this->coupleService = $coupleService;
        $this->entryService = $entryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('access', 'admin');

        $schedules = Schedule::all();

        return view('admin.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('access', 'admin');
        $halls = Hall::all();
        return view('schedules.create', compact('halls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        Gate::authorize('access', 'admin');

        $active = $request->active === 'on';
        if ($active) {
            Schedule::where('hall_id', $request->hall_id)->update([
                'active' => false
            ]);
        }
        $schedule = Schedule::create($request->only('startdate', 'enddate', 'starttime', 'endtime', 'hall_id') + ['active' => $active]);
        $this->coupleService->addCouples($schedule, $request->starttime, $request->endtime, $request->couples);
        return redirect()->route('schedules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Schedule $schedule)
    {
        Gate::authorize('access', 'admin');

        $halls = Hall::whereHas('schedules', function (Builder $query) {
            $query->where('active', true);
        })->get();

        $hall = $halls->get(0);
        $couples = $schedule->couples()->with('entries')->get();

        $this->validate($request, [
            'date' => 'date_format:"Y-m-d"'
        ]);

        return view('schedules.show', [
            'schedule' => $schedule,
            'date' => $request->input('date', $schedule->startdate),
            'service' => $this->entryService,
            'halls' => $halls,
            'hall' => $hall,
            'couples' => $couples,
            'isAdmin' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        Gate::authorize('access', 'admin');
        $halls = Hall::all();
        return view('schedules.edit', compact('schedule', 'halls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ScheduleRequest  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        Gate::authorize('access', 'admin');

        $this->coupleService->update($schedule, $request->starttime, $request->endtime, $request->couples);
        $active = $request->active === 'on';
        if ($active) {
            Schedule::where('hall_id', $request->hall_id)->update([
                'active' => false
            ]);
        }
        $schedule->update($request->only('startdate', 'enddate', 'starttime', 'endtime', 'hall_id') + ['active' => $active]);

        return redirect()->route('schedules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        Gate::authorize('access', 'admin');

        $schedule->delete();

        return redirect()->route('schedules.index');
    }

    public function active(Request $request)
    {
        $halls = Hall::whereHas('schedules', function (Builder $query) {
            $query->where('active', true);
        })->get();

        if (empty($halls)) {
            abort(404);
        }

        $hall = $halls->get(0);

        if ($request->filled('hall_id') && $halls->contains('id', $request->hall_id)) {
            $hall = Hall::findOrFail($request->hall_id); // $halls->where('id', $request->hall_id)->get(0);
        }
        $schedule = $hall->schedules()->where('active', true)->firstOrFail();
        $couples = $schedule->couples()->with('entries')->get();

        return view('schedules.show', [
            'schedule' => $schedule,
            'hall' => $hall,
            'halls' => $halls,
            'date' => $request->input('date', $schedule->startdate),
            'service' => $this->entryService,
            'couples' => $couples,
            'format_couples' => CoupleResource::collection($couples),
            'isAdmin' => false
        ]);
    }
}
