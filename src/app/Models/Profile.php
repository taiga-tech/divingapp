<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'comment',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    public function posts() {
        return $this->hasMany('App\Models\Post');
    }
}