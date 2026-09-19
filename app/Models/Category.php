<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'status'
    ];

    public function designs()
    {
        return $this->hasMany(Design::class);
    }
}