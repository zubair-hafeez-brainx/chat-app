<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

Relation::morphMap([
    'Group' => 'App\Models\Group',
    'User' => 'App\Models\User',
]);

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'from',
        'messagable_type',
        'messagable_id',
        'message',
        'file'
    ];

    public function messagable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'from');
    }
}
