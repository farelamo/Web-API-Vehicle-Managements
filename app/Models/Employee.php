<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'age', 'address'];

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
