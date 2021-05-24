<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'surname', 'name', 'patronymic', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_code',
        'two_factor_expires_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'two_factor_expires_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function maintenanceEntries()
    {
        return $this->hasMany(MaintenanceEntry::class, 'employee_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $user->giveRole('user');
        });
    }

    public function hasRoles(...$slugs)
    {
        foreach ($slugs as $slug) {
            if ($this->roles->contains('slug', $slug)) {
                return true;
            }
        }

        return false;
    }

    public function giveRole($slug)
    {
        $role = Role::where('slug', $slug)->firstOrFail();
        $this->roles()->attach($role);
    }
}
