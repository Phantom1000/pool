<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Couple
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $start
 * @property \Illuminate\Support\Carbon $end
 * @property int|null $schedule_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entry[] $entries
 * @property-read int|null $entries_count
 * @property-read \App\Models\Schedule|null $schedule
 * @method static \Illuminate\Database\Eloquent\Builder|Couple newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Couple newQuery()
 * @method static \Illuminate\Database\Query\Builder|Couple onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Couple query()
 * @method static \Illuminate\Database\Eloquent\Builder|Couple whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Couple whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Couple whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Couple whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Couple whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Couple whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Couple whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Couple withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Couple withoutTrashed()
 */
	class Couple extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Entry
 *
 * @property int $id
 * @property string|null $uuid
 * @property int $lane
 * @property \Illuminate\Support\Carbon $date
 * @property int|null $couple_id
 * @property int|null $user_id
 * @property int $state
 * @property int $places
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Couple|null $couple
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Entry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry newQuery()
 * @method static \Illuminate\Database\Query\Builder|Entry onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereCoupleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereLane($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry wherePlaces($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|Entry withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Entry withoutTrashed()
 */
	class Entry extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hall
 *
 * @property int $id
 * @property string $name
 * @property int $floor
 * @property int $lanes
 * @property int $places
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Schedule[] $schedules
 * @property-read int|null $schedules_count
 * @method static \Illuminate\Database\Eloquent\Builder|Hall newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall newQuery()
 * @method static \Illuminate\Database\Query\Builder|Hall onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall query()
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereFloor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereLanes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall wherePlaces($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Hall whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Hall withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Hall withoutTrashed()
 * @mixin \Eloquent
 */
	class Hall extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Maintenance
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MaintenanceEntry[] $maintenanceEntries
 * @property-read int|null $maintenance_entries_count
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance newQuery()
 * @method static \Illuminate\Database\Query\Builder|Maintenance onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Maintenance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Maintenance withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Maintenance withoutTrashed()
 */
	class Maintenance extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MaintenanceEntry
 *
 * @property int $id
 * @property string $date
 * @property \Illuminate\Support\Carbon $time
 * @property int|null $employee_id
 * @property int $maintenance_id
 * @property int $perform
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $employee
 * @property-read \App\Models\Maintenance $maintenance
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry newQuery()
 * @method static \Illuminate\Database\Query\Builder|MaintenanceEntry onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry whereMaintenanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry wherePerform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MaintenanceEntry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|MaintenanceEntry withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MaintenanceEntry withoutTrashed()
 */
	class MaintenanceEntry extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Query\Builder|Role onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Role withoutTrashed()
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Schedule
 *
 * @property int $id
 * @property string $startdate
 * @property \Illuminate\Support\Carbon $enddate
 * @property \Illuminate\Support\Carbon $starttime
 * @property \Illuminate\Support\Carbon $endtime
 * @property int|null $hall_id
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Couple[] $couples
 * @property-read int|null $couples_count
 * @property-read \App\Models\Hall|null $hall
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule active()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule newQuery()
 * @method static \Illuminate\Database\Query\Builder|Schedule onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereEnddate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereEndtime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereHallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStartdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereStarttime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Schedule withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Schedule withoutTrashed()
 */
	class Schedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $username
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entry[] $entries
 * @property-read int|null $entries_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MaintenanceEntry[] $maintenanceEntries
 * @property-read int|null $maintenance_entries_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

