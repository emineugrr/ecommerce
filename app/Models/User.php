<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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

    // --- HOCANIN İSTEDİĞİ İLİŞKİLER VE ROL KONTROLLERİ ---

    /**
     * Kullanıcının eklediği ürünler (One-to-Many)
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class); // [cite: 918]
    }

    /**
     * Kullanıcının rolleri (Many-to-Many)
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class); // [cite: 922]
    }

    /**
     * Kullanıcı belirli bir role sahip mi kontrolü
     */
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists(); // [cite: 925]
    }

    /**
     * Kullanıcı verilen rollerden herhangi birine sahip mi kontrolü
     */
    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->exists(); // [cite: 927]
    }
}
