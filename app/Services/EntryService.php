<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class EntryService
{
    public function validator($data)
    {
        return Validator::make($data, [
            'check_date' => 'required|date_format:"Y-m-d"',
            'couple' => 'required|integer|min:1',
            'lane' => 'required|integer|min:1',
            'places' => 'required|integer|min:1',
            'hall' => 'required|integer|min:1'
        ]);
    }

    public function check($lane, $date, $couple, $places, $hall)
    {
        return $this->calculate($lane, $date, $couple, $hall) > $places - 1;
    }

    public function calculate($lane, $date, $couple, $hall)
    {
        $count = 0;

        $entries = $couple->entries;
        $entries = $couple->entries->filter(function ($entry) use ($lane, $date) {
            return $entry->lane == $lane && $entry->date->format('Y-m-d') === $date;
        });
        $entries->each(function ($entry) use (&$count) {
            $count += $entry->places;
        });
        return $hall->places - $count;
    }
}
