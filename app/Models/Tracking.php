<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'task_id',
        'started_at',
    ];

    protected $appends = [
        'duration',
        'duration_time',
    ];

    public $timestamps = false;

    protected $table = 'tracking';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function getStartedAt(): string
    {
        return $this->getAttribute('started_at');
    }

    public function getStoppedAt(): ?string
    {
        return $this->getAttribute('stopped_at');
    }

    public function getDurationAttribute(): int
    {
        $stoppedTime = $this->getStoppedAt() ? Carbon::parse($this->getStoppedAt()) : now();

        return $stoppedTime->diffInSeconds($this->getStartedAt());
    }

    public function getDurationTimeAttribute(): string
    {
        return Carbon::parse($this->getDurationAttribute())->toTimeString();
    }
}
