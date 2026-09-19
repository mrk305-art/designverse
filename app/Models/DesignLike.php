<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Design;
use App\Models\User;

class DesignLike extends Model
{
    protected $fillable = [
        'user_id',
        'design_id',
    ];

    public function design()
    {
        return $this->belongsTo(Design::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

