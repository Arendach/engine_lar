<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $access
 * @property string $pin
 * @property string $name
 * @property string $instruction
 * @property float $reserve_funds
 * @property float $rate
 * @property int $archive
 * @property int $schedule_notice
 * @property int $position
 * @property int $is_courier
 * @property string|null $theme
 * @property-read mixed $is_online
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User couriers()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsCourier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereReserveFunds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereScheduleNotice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTheme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 * @mixin \Eloquent
 * @property-read mixed $theme_path
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Notification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property string $user_access_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUserAccessId($value)
 * @property-read \App\Models\UserAccess $user_access
 * @property-read mixed $full_name
 * @property-read mixed $online_color
 * @property-read mixed $online_text
 */
class User extends Model
{
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'login',
        'password',
        'email',
        'first_name',
        'last_name',
        'created_at',
        'updated_at',
        'deleted_at',
        'access',
        'pin',
        'name',
        'instruction',
        'reserve_funds',
        'rate',
        'archive',
        'schedule_notice',
        'position',
        'is_courier',
        'theme'
    ];

    public function scopeCouriers(Builder $query): void
    {
        $query->where('is_courier', 1);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)
            ->where('see', 0);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class)
            ->where('is_success', 0);
    }

    public function user_access()
    {
        return $this->belongsTo(UserAccess::class);
    }

    public function getCountAttachDelivery(): int
    {
        return Order::delivery()->iCourier()->opened()->count();
    }

    public function getNotMovingMoney()
    {
        return Report::my()->type('moving')->where('data', 'like', '%:0')->get();
    }

    public function getMovingMoney()
    {
        return Report::where('data', 'like', user()->id . ':0');
    }

    public function getCountLiableDelivery()
    {
        $from = date('Y-m-d', time() - 60 * 60 * 24 * 90);
        $to = date('Y-m-d', time() + 60 * 60 * 24 * 365);

        return Order::iLiable()->delivery()->whereBetween('created_at', [$from, $to])->count();
    }

    public function getCountLiableSelf()
    {
        $from = date('Y-m-d', time() - 60 * 60 * 24 * 90);
        $to = date('Y-m-d', time() + 60 * 60 * 24 * 365);

        return Order::iLiable()->self()->whereBetween('created_at', [$from, $to])->count();
    }

    public function getCountAttachSending()
    {
        return Order::sending()->iCourier()->opened()->count();
    }

    public function getCountAttachSelf()
    {
        return Order::self()->iCourier()->opened()->count();
    }

    public function getCountAttachDeliveryUser(int $user_id): int
    {
        return Order::whereCourierId($user_id)->delivery()->opened()->count();
    }

    public function getCountAttachSelfUser(int $user_id): int
    {
        return Order::whereCourierId($user_id)->self()->opened()->count();
    }

    public function getCountAttachSendingUser(int $user_id): int
    {
        return Order::whereCourierId($user_id)->sending()->opened()->count();
    }

    public function getThemePathAttribute(): string
    {
        $theme = $this->theme;
        if (is_null($theme)) return asset("css/themes/flatfly.css");
        else return asset("css/themes/$theme.css");
    }

    public function getSchedulesNotWrite(): int
    {
        $countWrite = Schedule::whereMonth('date', date('m'))->whereYear('date', date('Y'))->where('user_id', user()->id)->count();

        return (int)date('d') - $countWrite - 1;
    }

    public function getPreviousSchedulesNotWrite(): int
    {
        $year = previous_month_with_year()['year'];
        $month = previous_month();

        $countWrite = Schedule::where('user_id', user()->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count();

        return (int)date('t', strtotime("$year-$month-01")) - $countWrite - 1;
    }

    public function getIsOnlineAttribute(): bool
    {
        return time() - $this->updated_at->timestamp < 300;
    }

    public function getOnlineTextAttribute()
    {
        return $this->is_online ? 'Online' : 'Offline';
    }

    public function getOnlineColorAttribute()
    {
        return $this->is_online ? 'green' : 'red';
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function accessCheck(string $key = 'ROOT'): bool
    {
        if ($this->user_access_id < 0) return true;
        elseif ($this->user_access_id == 0) return false;
        else return in_array($key, $this->user_access->array_params);
    }
}