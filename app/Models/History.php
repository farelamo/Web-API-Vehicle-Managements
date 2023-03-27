<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'description', 'spv_employee_id', 
        'spv_admin_id', 'vehicle_id', 'employee_id', 
        'start_date', 'end_date', 'distance', 'fuel',
        'spv_admin_approve', 'spv_employee_approve'
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function spv_employee()
    {
        return $this->belongsTo(User::class, 'spv_employee_id', 'id');
    }

    public function spv_admin()
    {
        return $this->belongsTo(User::class, 'spv_admin_id', 'id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}