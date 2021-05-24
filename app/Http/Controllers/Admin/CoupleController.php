<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Services\CoupleService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CoupleController extends Controller
{
    private $coupleService;

    public function __construct(CoupleService $coupleService)
    {
        $this->coupleService = $coupleService;
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

        return view('couples.edit', compact('schedule'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Schedule $schedule, Request $request)
    {
        Gate::authorize('access', 'admin');

        for ($i = 0, $n = count($request->starts); $i < $n; $i++) {
            if (strtotime($request->starts[$i]) >= strtotime($request->ends[$i])) {
                return redirect()->route('couples.edit', $schedule)->withError(true);
            }
        }
        $this->coupleService->updateCouples($schedule, $request->starts, $request->ends);

        return redirect()->route('schedules.index');
    }
}
