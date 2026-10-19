<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChangeRoleLog extends Model
{
    protected $table = 'activity_logs';
    protected $fillable = [
        'id_user',
        'action',
        'target_user_id',
        'old_role',
        'new_role',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function targetUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_user_id', 'id_user');
    }
}