<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
     protected $fillable = [
        'equipment_name',
        'quantity_available',
        'department_id'
    ];

    public function requests()
    {
        return $this->hasMany(UserRequest::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
