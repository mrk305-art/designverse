<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\DesignLike;
use App\Models\Follow;
use App\Models\DesignComment;
use App\Models\Notification;
use App\Models\Design;
use App\Models\DesignSave;
use App\Models\Collection;
use App\Models\Report;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'username',
    'email',
    'password',
    'role',
    'profile_photo',
    'is_verified',
    'status',
];

public function profile()
{
    return $this->hasOne(Profile::class);
}

public function designs()
{
    return $this->hasMany(Design::class);
}



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function designLikes()
{
    return $this->hasMany(DesignLike::class);
}


public function followers()
{
    return $this->hasMany(Follow::class, 'following_id');
}

public function following()
{
    return $this->hasMany(Follow::class, 'follower_id');
}

public function designComments()
{
    return $this->hasMany(DesignComment::class);
}


public function notifications()
{
    return $this->hasMany(Notification::class);
}


public function savedDesigns()
{
    return $this->hasMany(DesignSave::class);
}

public function collections()
{
    return $this->hasMany(Collection::class);
}

public function reports()
{
    return $this->hasMany(Report::class);
}






}
