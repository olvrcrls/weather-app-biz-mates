<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    /**
     * Returns the user that saved the weather condition
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
