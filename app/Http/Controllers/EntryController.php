<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Entry;
use App\Models\Couple;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\EntryService;
use Illuminate\Support\Facades\Gate;

class EntryController extends Controller
{
    private $entryService;

    public function __construct(EntryService $entryService)
    {
        $this->entryService = $entryService;
    }

    public function check(Request $request)
    {

        $validator = $this->entryService->validator($request->all());

        if (!$validator->fails()) {
            $couple = Couple::with('entries', 'schedule')->findOrFail($request->couple);
            if ($request->check_date >= $couple->schedule->startdate && $request->check_date <= $couple->schedule->enddate) {
                $hall = Hall::findOrFail($request->hall);
                if ($this->entryService->check($request->lane, $request->check_date, $couple, $request->places, $hall)) {
                    return 1;
                }
                return 2;
            }
        }
        return 3;
    }

    public function book(Request $request)
    {

        $validator = $this->entryService->validator($request->all());

        if (!$validator->fails()) {
            $couple = Couple::with('entries', 'schedule')->findOrFail($request->couple);
            if ($request->check_date >= $couple->schedule->startdate && $request->check_date <= $couple->schedule->enddate) {
                $hall = Hall::findOrFail($request->hall);
                if ($this->entryService->check($request->lane, $request->check_date, $couple, $request->places, $hall)) {
                    $entry = Entry::create([
                        'date' => $request->check_date,
                        'lane' => $request->lane,
                        'places' => $request->places
                    ]);
                    $couple->entries()->save($entry);
                    $request->user()->entries()->save($entry);
                }
                return redirect()->route('schedules.active', ['date' => $request->select, 'hall_id' => $request->hall]);
            }
        }
        return redirect()->route('schedules.active', ['date' => $request->select, 'hall_id' => $request->hall])->withError(true);
    }
}
