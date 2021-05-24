<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Builder;

class ProfileController extends Controller
{
    public function index()
    {
        Gate::authorize('access', 'admin');

        $roles = Role::all();
        $users = User::whereHas('roles', function (Builder $query) {
            $query->where('slug', 'admin');
        }, 0)->paginate(10);

        return view('profiles.index', compact('users', 'roles'));
    }

    public function show(User $profile, Request $request)
    {
        $params['user'] = $profile;
        $params['schedule'] = Schedule::where('active', true)->firstOrFail();

        $roles = '';
        $profile->roles->each(function (Role $role) use (&$roles) {
            $roles .= "$role->name, ";
        });
        $params['roles'] = Str::substr($roles, 0, -2);

        $entries = $profile->entries();
        if ($request->filled('lanes')) {
            $entries = $entries->whereIn('lane', $request->lanes);
            $params['lanes'] = $request->lanes;
        }

        if ($request->filled('time')) {
            $entries = $entries->whereIn('couple_id', $request->time);
            $params['couples'] = $request->time;
        }

        if ($request->filled('date')) {
            $entries = $entries->where('date', $request->date);
            $params['date'] = $request->date;
        }
        $params['entries'] = $entries->with('couple', 'user')->latest()->paginate(10);

        return view('profiles.show', $params + ['roles' => Str::substr($roles, 0, -2), 'entries' => $entries->with('couple', 'user')->latest()->paginate(10)]);
    }

    public function edit(User $profile)
    {
        return view('profiles.edit', [
            'user' => $profile
        ]);
    }
}
