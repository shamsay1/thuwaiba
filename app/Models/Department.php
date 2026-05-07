<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department_name'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function requests()
    {
        return $this->hasMany(UserRequest::class);
    }
}
