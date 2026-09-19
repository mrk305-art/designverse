<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdminActivity extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'message',
        'design_id',
        'is_read',
    ];


    protected $casts = [
        'is_read' => 'boolean',
    ];


    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Design
    |--------------------------------------------------------------------------
    */

    public function design(): BelongsTo
    {
        return $this->belongsTo(Design::class);
    }


    /*
    |--------------------------------------------------------------------------
    | Create Activity
    |--------------------------------------------------------------------------
    */

    public static function createActivity(
        string $type,
        string $message,
        ?int $userId = null,
        ?int $designId = null
    ): self {

        return self::create([
            'type' => $type,
            'message' => $message,
            'user_id' => $userId,
            'design_id' => $designId,
            'is_read' => false,
        ]);
    }
}