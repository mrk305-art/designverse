<?php

namespace App\Models;

use App\Models\DesignImage;
use Illuminate\Database\Eloquent\Model;
use App\Models\DesignLike;
use App\Models\DesignComment;
use App\Models\DesignSave;
use App\Models\Collection;
use App\Models\Report;

class Design extends Model
{
    protected $fillable = [

        'user_id',

        'category_id',

        'title',

        'slug',

        'description',

        'visibility',

        'status',

        'published_at'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

 public function images()
{
    return $this->hasMany(DesignImage::class)
        ->orderBy('sort_order');
}

public function likes()
{
    return $this->hasMany(DesignLike::class);
}

public function comments()
{
    return $this->hasMany(DesignComment::class);
}


public function saves()
{
    return $this->hasMany(DesignSave::class);
}

public function collections()
{
    return $this->belongsToMany(
        Collection::class,
        'collection_design'
    )->withTimestamps();
}

public function reports()
{
    return $this->hasMany(Report::class);
}

}