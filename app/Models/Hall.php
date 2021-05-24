<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Hall extends Model
{
    use HasFactory, SoftDeletes, HasRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'floor', 'lanes', 'places'];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function entries()
    {
        return $this->hasManyDeep(Entry::class, [Schedule::class, Couple::class]);
    }
}
