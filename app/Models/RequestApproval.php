<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestApproval extends Model
{
    protected $fillable = [
        'request_id',
        'approved_by',
    ];

    public function request()
    {
        return $this->belongsTo(UserRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
