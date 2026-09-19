<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Design;
use App\Models\User;

class DesignComment extends Model
{
    protected $fillable = [
        'design_id',
        'user_id',
        'comment',
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

