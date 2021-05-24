<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'startdate', 'enddate', 'starttime', 'endtime', 'active', 'hall_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at', 'enddate', 'starttime', 'endtime'
    ];

    public function couples()
    {
        return $this->hasMany(Couple::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function scopeActive($query)
    {
        return $query->where('active', true)->firstOrFail();
    }
}
