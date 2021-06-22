<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    public function messagable(){
        return $this->morphMany(Message::class, 'messagable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function members()
    {
        return $this->belongsToMany(User::class,'group_users','group_id','user_id');
    }
}
