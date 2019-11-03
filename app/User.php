<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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

    public function roles()
    {
        return $this->belongsToMany('App\Model\Role', 'user_roles', 'user_id', 'role_id');
    }


    public function hasAnyRole($roles)
    {
        if (is_array($roles))
        {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function isADMIN()
    {
        return $this->hasRole('ADMIN');
    }


    // TECHNICAL DIVISION

    public function isCEPS()
    {
        return $this->hasRole('CEPS');
    }

    public function isESII()
    {
        return $this->hasRole('ESII');
    }

    public function isEPS()
    {
        return $this->hasRole('EPS');
    }

    // END TECHNICAL DIVISION

    // ADMINISTRATIVE

    public function isCAO()
    {
        return $this->hasRole('CAO');
    }

    public function isACCT()
    {
        return $this->hasRole('ACCT');
    }

    public function isSECRETARY()
    {
        return $this->hasRole('SECRETARY');
    }

    public function isCASHIER()
    {
        return $this->hasRole('CASHIER');
    }

    public function isRECORD()
    {
        return $this->hasRole('RECORD');
    }

    public function isPACD()
    {
        return $this->hasRole('PACD');
    }

    public function isPURCHASER()
    {
        return $this->hasRole('PURCHASER');
    }

    public function delete()
    {
        $this->roles()->delete();
        return parent::delete();
    }

    // END ADMINISTRATIVE

}
