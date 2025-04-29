<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    // public Role $roles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'address',
        'phone',
        'postal_code',
        'email',
        'password',
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
        ];
    }

    protected function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Generar el username base
            $baseUsername = strtolower(substr($user->first_name, 0, 1) . $user->last_name);
            $username = $baseUsername;

            // Verificar si el username ya existe y agregar un número si es necesario
            $counter = 1;
            while (User::where('username', $username)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            $user->username = $username;
        });
    }


    public function healthcareWorker()
    {
        return $this->hasOne(HealthcareWorker::class);
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class, 'user_id');
    }
}
