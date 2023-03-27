<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'schedule_service'];

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
