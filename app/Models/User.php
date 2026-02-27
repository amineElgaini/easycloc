<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'role',
        'reputation',
        'is_banned',
        'banned_at',
    ];

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
            'banned_at' => 'datetime',
            'is_banned' => 'boolean',
        ];
    }

    public function ownedColocations()
    {
        return $this->hasMany(Colocation::class, 'owner_id');
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    // bring collocations
    public function colocations()
    {
        return $this->belongsToMany(Colocation::class, 'memberships')
            ->withPivot('left_at')
            ->withTimestamps();
    }

    public function paidExpenses()
    {
        return $this->hasMany(Expense::class, 'paid_by');
    }

    public function expenseShares()
    {
        return $this->hasMany(ExpenseShare::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
