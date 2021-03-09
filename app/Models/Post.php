<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory, UsesUuid;

    protected $fillable = ['id', 'user_id', 'body',];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
