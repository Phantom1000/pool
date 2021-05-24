<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'lane' => $this->lane,
            'date' => $this->date->format('d.m.Y'),
            'couple' => $this->couple,
            'entry.couple.schedule.hall' => $this->couple->schedule->hall,
            'user' => $this->user,
            'state' => $this->state,
            'places' => $this->places,
            'start' => $this->couple->start->format('H:i'),
            'end' => $this->couple->end->format('H:i'),
        ];
    }
}
