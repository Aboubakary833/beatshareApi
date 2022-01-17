<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'name',
        'picture',
        'visibility',
        'userId'
    ];

    protected $hidden = ['id', 'userId'];

    public function user() {
        $this->belongsTo(User::class, 'userId');
    }
}
