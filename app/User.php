<?php

namespace App;

use App\Models\Rank;
use App\Types\RoleType;
use App\Models\CaseReport;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(): bool
    {
        return $this->hasRole(RoleType::ADMIN);
    }

    public function isPoliceAdmin(): bool
    {
        return $this->hasRole(RoleType::POLICEADMIN);
    }

    public function isBrgyAdmin(): bool
    {
        return $this->hasRole(RoleType::BRGYADMIN);
    }

    public function isComplainant(): bool
    {
        return $this->hasRole(RoleType::COMPLAINANT);
    }

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function preparedCaseReports()
    {
        return $this->hasMany(CaseReport::class, 'prepared_id');
    }
}
