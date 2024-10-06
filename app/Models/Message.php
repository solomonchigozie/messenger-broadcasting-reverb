<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'sender_id',
        'group_id',
        'receiver_id',
    ];

    //a message should belong to a reciever
    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    //a message should belong to a reciever
    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    //a message can belong to a group
    public function group() {
        return $this->belongsTo(Group::class);
    }

    //a message can have many attachments
    public function attachments() {
        return $this->hasMany(MessageAttachment::class);
    }


}
