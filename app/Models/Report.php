<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    protected $fillable = [
        'user_id',
        'design_id',
        'reason',
        'description',
        'status',
        'admin_note',
    ];

    /**
     * User who submitted the report.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Reported design.
     */
    public function design(): BelongsTo
    {
        return $this->belongsTo(Design::class);
    }
}