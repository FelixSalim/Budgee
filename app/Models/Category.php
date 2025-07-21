<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'planned_outlay',
        'type',
        'icon',
        'icon_color',
    ];

    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
