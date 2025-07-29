<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // Still need this import

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'planned_outlay',
        'type',
        'icon',
        'icon_color',
    ];

    /**
     * Get the planned outlay formatted for display.
     * This accessor will automatically be called when you access $category->planned_outlay_formatted.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function plannedOutlayFormatted(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) { // <-- Changed from 'fn' to 'function'
                // Get the raw decimal value from the attributes array
                $rawOutlay = (float) $attributes['planned_outlay'];

                // Check if the number has a fractional part (i.e., not a whole number)
                // Using a small epsilon to account for floating-point inaccuracies
                $epsilon = 0.000001;
                if (abs($rawOutlay - round($rawOutlay)) < $epsilon) {
                    // If it's a whole number, format without decimals
                    return number_format($rawOutlay, 0, '.', ',');
                } else {
                    // If it has decimals, format with 2 decimal places
                    return number_format($rawOutlay, 2, '.', ',');
                }
            }
        );
    }

    /**
     * Get the transactions for the category.
     */
    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the user that owns the category.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
