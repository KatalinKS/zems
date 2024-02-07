<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\DTO\OrderBy;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    //Tracking
    public function tracking()
    {
        return $this->hasMany(Tracking::class);
    }

    public function newTracking(array $data): void
    {
        $this->tracking()->create($data);
    }

    public function updateActiveTracking(array $data): void
    {
        $this->tracking()->whereNull('stopped_at')->update($data);
    }

    public function hasActiveTracking(): bool
    {
        return $this->tracking()->whereNull('stopped_at')->count() >= 1;
    }

    public function getStoppedTracking(OrderBy $orderBy = new OrderBy()): Collection
    {
        return $this->tracking()->whereNotNull('stopped_at')
            ->orderBy($orderBy->column, $orderBy->direction)
            ->get();
    }

    public function getActiveTracking(): ?Tracking
    {
        return $this->tracking()->whereNull('stopped_at')->orderByDesc('started_at')->first();
    }
}
