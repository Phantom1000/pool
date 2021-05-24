<?php

namespace Database\Seeders;

use App\Models\Couple;
use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = [
            [
                'startdate' => '2020-12-20',
                'enddate' => '2020-12-30',
                'starttime' => '08:00:00',
                'endtime' => '20:00:00',
                'active' => true
            ],
            [
                'startdate' => '2020-12-15',
                'enddate' => '2020-12-22',
                'starttime' => '10:00:00',
                'endtime' => '21:00:00',
                'active' => true
            ]
        ];

        $n = 1;

        foreach ($schedules as $item) {
            $schedule = Schedule::create($item);
            $schedule->hall()->associate($n++);
            $schedule->save();
            $worktime = strtotime($schedule->endtime) - strtotime($schedule->starttime);
            $coupletime = $worktime / 10;
            for ($i = 0; $i < 10; $i++) {
                $time = strtotime($schedule->starttime) + $coupletime * $i;
                $start = date("H:i:s", $time);
                $end = date("H:i:s", $time + $coupletime);
                $schedule->couples()->save(Couple::create([
                    'start' => $start,
                    'end' => $end
                ]));
            }
        }
    }
}
