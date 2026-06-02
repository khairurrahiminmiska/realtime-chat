<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Group;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'group_id',
        'message'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}