<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Thread extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = ['user_id', 'channel_id', 'title', 'body'];

    protected $with = ['owner', 'channel'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
        });

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });

        static::deleting(function ($model) {
            $model->replies()->delete();
        });
    }

    /**
     * Generate thread path
     *
     * @return string
     */
    public function path(): string
    {
        return route('threads.show', ['channel' => $this->channel, 'thread' => $this->id]);
    }

    /**
     * Relate thread to his owner
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relate thread to channel
     *
     * @return BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Relate thread to his replies
     *
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
