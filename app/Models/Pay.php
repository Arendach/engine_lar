<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pay extends Model
{
    protected $table = 'pays';

/*    protected $fillable = [
        'name',
        'merchant_id',
        'provider',
        'address',
        'ipn',
        'account',
        'bank',
        'mfo',
        'phone',
        'director',
        'is_cashless',
        'is_pdv'
    ];*/

    protected $guarded = [];

    public $timestamps = false;

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }
}