<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'place',
        'user_id',
        'profile_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function profile() {
        return $this->belongsTo('App\Models\Profile');
    }

    public function images() {
        return $this->hasMany('App\Models\PostImage');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }
}
