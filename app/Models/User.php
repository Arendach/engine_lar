<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'users';

    protected $guarded = [];

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

    public function position()
    {
        return $this->belongsTo(UserPosition::class, 'user_position_id');
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
        return true;
        if ($this->user_access_id < 0) return true;
        elseif ($this->user_access_id == 0) return false;
        else return in_array($key, $this->user_access->array_params);
    }
}