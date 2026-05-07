<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
      protected $fillable = [
        "firstname",
        "middlename",
        "lastname",
        "gender",
        "email",
        "mobile",
        "role",
        "department_id",
        "password",
        "status"
      ];

      public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function requests()
    {
        return $this->hasMany(UserRequest::class, 'teacher_id');
    }

    public function approvals()
    {
        return $this->hasMany(RequestApproval::class, 'approved_by');
    }

}
