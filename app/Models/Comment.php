<?php

namespace App\Models;

use App\Enums\Comment\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'user_id', 'name', 'email', 'body', 'status'];

    protected $casts = ['status' => Status::class];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk mendapatkan nama penulis (user atau guest)
    public function getAuthorNameAttribute(): string
    {
        return $this->user ? $this->user->name : $this->name;
    }
}
