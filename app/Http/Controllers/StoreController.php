<?php

namespace App\Http\Controllers;

use App\Events\ChangeEntryEvent;
use App\Models\Hall;
use App\Models\Role;
use App\Models\User;
use App\Models\Entry;
use App\Models\Couple;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\QrcodeService;
use App\Models\MaintenanceEntry;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\EntryResource;
use App\Notifications\ChangeEntryNotification;
use Illuminate\Database\Eloquent\Builder;

class StoreController extends Controller
{
    public function getEntries(Request $request)
    {
        $title = 'Добро пожаловать';
        $entries = Entry::query();

        $hall = Hall::find($request->hall_id);
        if (Auth::check()) {
            if (Gate::allows('access', 'staff')) {
                $title = 'Записи профилактических работ';
                $entries = MaintenanceEntry::where('perform', false)->where(function (Builder $query) use ($request) {
                    $query->where('employee_id', $request->user()->id)->orWhere('employee_id', null);
                })->with('maintenance', 'employee')->paginate(10);
                return view('employee', compact('title', 'entries'));
            }
            if (isset($hall)) {
                $entries = $hall->entries();
            }
            if (Gate::allows('access', 'admin')) {
                $title = 'Все записи';
                $entries = $entries->latest();
            } elseif (Gate::allows('access', 'seller')) {
                $title = 'Записи для оплаты';
                $entries = $entries->where('state', 0);
            } elseif (Gate::allows('access', 'controller')) {
                $title = 'Записи для пропуска';
                $entries = $entries->where('state', 1);
            } elseif (Gate::allows('access', 'trainer')) {
                $title = 'Записи для проверки посещения';
                $entries = $entries->where('state', 2);
            } elseif (Gate::allows('access', 'user')) {
                $title = 'Ваши записи';
                $entries = $entries->where('user_id', $request->user()->id);
            }
        }
        $params['title'] = $title;

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

    public function pay(Entry $entry)
    {
        Gate::authorize('access', 'seller');

        $old = $entry->uuid;
        $entry->update([
            'uuid' => Str::uuid(),
            'state' => 1
        ]);
        QrcodeService::update($old, $entry->uuid);

        //broadcast(new ChangeEntryEvent('Test!!!'))->toOthers();
        /*User::get(4)->notify(new ChangeEntryNotification());*/
        $controllers = Role::firstWhere('slug', 'controller')->users;
        $controllers->each(function (User $controller) {
            $controller->notify(new ChangeEntryNotification());
        });

        return $entry;
    }

    public function pass(Entry $entry)
    {
        Gate::authorize('access', 'controller');

        $old = $entry->uuid;
        $entry->update([
            'uuid' => Str::uuid(),
            'state' => 2
        ]);
        QrcodeService::update($old, $entry->uuid);

        $trainers = Role::firstWhere('slug', 'trainer')->users;
        $trainers->each(function (User $trainer) {
            $trainer->notify(new ChangeEntryNotification());
        });

        return $entry;
    }

    public function destroy(Entry $entry)
    {
        QrcodeService::delete($entry->uuid);
        $entry->delete();
        return response(null, 204);
    }
}
