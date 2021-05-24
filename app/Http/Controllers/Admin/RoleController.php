<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        Gate::authorize('access', 'admin');

        if (!$user->roles->contains($request->role)) {
            $user->roles()->attach($request->role);
        }

        return redirect()->route('profiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Role $role)
    {
        Gate::authorize('access', 'admin');

        $user->roles()->detach($role);

        return redirect()->route('profiles.index');
    }
}
