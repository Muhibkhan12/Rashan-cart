<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['role_id', 'name', 'email', 'phone', 'password', 'status', 'email_verified_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ---------- Relations ----------

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function supplier(): HasOne
    {
        return $this->hasOne(Supplier::class);
    }

    // ---------- Role helpers ----------

    public function hasRole(string ...$names): bool
    {
        return $this->role && in_array($this->role->name, $names, true);
    }

    public function isAdmin(): bool       { return $this->hasRole('admin'); }
    public function isCustomer(): bool    { return $this->hasRole('customer'); }
    public function isSupplier(): bool    { return $this->hasRole('supplier'); }
    public function isRider(): bool       { return $this->hasRole('rider', 'delivery'); }
    public function isProcurement(): bool { return $this->hasRole('procurement'); }

    // ---------- Status helpers ----------

    public function isActive(): bool      { return $this->status === 'active'; }
    public function isSuspended(): bool   { return $this->status === 'suspended'; }
    public function isUnverified(): bool  { return $this->status === 'unverified'; }
}