<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Role;
use App\Models\User;
use App\Models\Entry;
use App\Models\Couple;
use App\Models\Schedule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\EntryResource;
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
        Gate::authorize('show', $profile);
        $params['user'] = $profile;
        $params['schedule'] = Schedule::where('active', true)->firstOrFail();

        $roles = '';
        $profile->roles->each(function (Role $role) use (&$roles) {
            $roles .= "$role->name, ";
        });
        $params['roles'] = Str::substr($roles, 0, -2);

        return view('profiles.show', $params + ['roles' => Str::substr($roles, 0, -2)]);
    }

    public function getEntries(Request $request)
    {
        $entries = Entry::query();

        $hall = Hall::find($request->hall_id);
        if (Auth::check()) {
            if (isset($hall)) {
                $entries = $hall->entries();
            }
            if (Gate::allows('access', 'user')) {
                $entries = $entries->where('user_id', $request->user()->id);
            }
        }

        if ($request->filled('uuid')) {
            $entries = $entries->where('uuid', $request->uuid);
        } else {
            if ($request->filled('lanes')) {
                $entries = $entries->whereIn('lane', $request->lanes);
            }

            if ($request->filled('stime') || $request->filled('etime')) {
                $couples = Couple::select('id');
                if ($request->filled('stime')) {
                    $couples = $couples->where('start', '>=', $request->stime);
                }
                if ($request->filled('etime')) {
                    $couples = $couples->where('end', '<=', $request->etime);
                }
                $couples = $couples->get();
                $entries = $entries->whereIn('couple_id', $couples);
            }

            if ($request->filled('splace')) {
                $entries = $entries->where('places', '>=', $request->splace);
            }

            if ($request->filled('eplace')) {
                $entries = $entries->where('places', '<=', $request->eplace);
            }

            if ($request->filled('date')) {
                $entries = $entries->where('date', $request->date);
            }
        }

        $entries = $entries->with('couple.schedule.hall', 'user')->latest()->get();
        if (empty($entries)) {
            $entries = null;
        }

        $params['entries'] = EntryResource::collection($entries);
        $params['halls'] = Hall::all();
        $params['hall'] = $hall;

        return $params;
    }

    public function edit(User $profile)
    {
        Gate::authorize('update', $profile);
        return view('profiles.edit', [
            'user' => $profile
        ]);
    }

    public function password(User $user)
    {
        Gate::authorize('update', $user);
        return view('profiles.change-password');
    }
}
