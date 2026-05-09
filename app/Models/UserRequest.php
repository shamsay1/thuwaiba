<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
     protected $fillable = [
        'user_id',
        'department_id',
        'equipment_id',
        'quantity',
        'reason',
        'overall_status',
        'request_date'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function approvals()
    {
        return $this->hasMany(RequestApproval::class);
    }
}
