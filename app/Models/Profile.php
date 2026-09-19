<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
    'user_id',
    'bio',
    'country',
    'city',
    'website',
    'github',
    'linkedin',
    'behance',
    'dribbble',
    'facebook',
    'instagram',
    'profile_photo',
    'cover_photo',
    'experience',
    'skills',
    'availability',
];

public function user()
{
    return $this->belongsTo(User::class);
}
}
