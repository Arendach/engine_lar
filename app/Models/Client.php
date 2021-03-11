<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    use Filterable;

    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'info',
        'group_id',
        'percentage',
        'manager_id',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_t'
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(ClientGroup::class);
    }
}