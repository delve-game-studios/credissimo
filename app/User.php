<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Order;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany('App\Role', 'user_roles');
    }

    public function hasRole($role) {
        $roles = $this->roles()->get();

        foreach($roles as $userRole) {
            if($userRole->name === $role) {
                return true;
            }
        }
        return false;
    }

    public function hasPendingOrders() {
        $pendingOrders = Order::where(['user_id' => $this->id, 'status' => 0])->get();
        return !$pendingOrders->isEmpty();
    }
}
