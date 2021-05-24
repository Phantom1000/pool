<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MaintenanceEntry;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class MainController extends Controller
{
    public function welcome(Request $request)
    {
        if (Auth::check()) {
            if (Gate::allows('access', 'staff')) {
                return view('employee', [
                    'entries' => MaintenanceEntry::where('perform', false)->where(function ($query) use ($request) {
                        $query->where('employee_id', $request->user()->id)->orWhere('employee_id', null);
                    })->with('maintenance', 'employee')->paginate(10),
                    'title' => 'Записи профилактических работ'
                ]);
            }
        }
        return view('welcome');
    }
}
