<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegularPayment extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'due_date',
        'status',
        'icon',
        'icon_color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
