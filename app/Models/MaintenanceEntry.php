<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceEntry extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'time', 'perform', 'maintenance_id', 'employee_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'time', 'date'];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}
