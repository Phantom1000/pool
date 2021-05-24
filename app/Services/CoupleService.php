<?php

namespace App\Services;

use App\Models\Couple;
use App\Models\Schedule;

class CoupleService
{
    public function update(Schedule $schedule, $starttime, $endtime, $couples)
    {
        if (strtotime($starttime) != strtotime($schedule->starttime) || strtotime($endtime) != strtotime($schedule->endtime) || $couples != $schedule->couples()->count()) {
            $schedule->couples()->delete();
            $this->addCouples($schedule, $starttime, $endtime, $couples);
        }
    }

    public function addCouples(Schedule $schedule, $starttime, $endtime, $couples)
    {
        $worktime = strtotime($endtime) - strtotime($starttime);
        $coupletime = $worktime / $couples;
        for ($i = 0; $i < $couples; $i++) {
            $time = strtotime($starttime) + $coupletime * $i;
            $start = date("H:i:s", $time);
            $end = date("H:i:s", $time + $coupletime);
            $schedule->couples()->save(Couple::create(compact('start', 'end')));
        }
    }

    public function updateCouples(Schedule $schedule, $starts, $ends)
    {
        $i = 0;
        $schedule->couples->each(function ($couple) use ($starts, $ends, &$i) {
            $couple->update([
                'start' => $starts[$i],
                'end' => $ends[$i++]
            ]);
        });
    }
}
