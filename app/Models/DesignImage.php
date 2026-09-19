<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Design;

class DesignImage extends Model
{
    protected $fillable = [
        'design_id',
        'image',
        'sort_order',
    ];

    public function design()
    {
        return $this->belongsTo(Design::class);
    }
}

