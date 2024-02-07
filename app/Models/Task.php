<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',
        'description'
    ];

    protected $appends = [
        'total_time_spent',
        'total_time_spent_sec',
        'my_time_spent',
        'my_time_spent_sec',
        'my_tracking'
    ];


    public function tracking()
    {
        return $this->hasMany(Tracking::class);
    }

    public function getTotalTimeSpentAttribute()
    {
        return Carbon::parse($this->getTotalTimeSpentSecAttribute())->toTimeString();
    }
    public function getTotalTimeSpentSecAttribute()
    {
        return $this->getRelationValue('tracking')->sum('duration');
    }
    public function getMyTimeSpentAttribute()
    {
        return Carbon::parse($this->getMyTimeSpentSecAttribute())->toTimeString();
    }

    public function getMyTimeSpentSecAttribute()
    {
        return $this->getRelationValue('tracking')->where('user_id', app(User::class)->getId())->sum('duration');
    }

    public function getMyTrackingAttribute()
    {
        return collect(array_values($this->getRelationValue('tracking')?->where('user_id', app(User::class)->getId())->toArray()));
    }
}
