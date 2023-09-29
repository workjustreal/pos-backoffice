<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    const admin = 1;
    const user = 0;

    const roleAdmin = 1;
    const roleUser = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $connection = 'mysql2';
    protected $table = 'users';
    protected $fillable = [
        'emp_id',
        'name',
        'surname',
        'image',
        'email',
        'password',
        'is_admin',
        'is_role',
        'is_login',
        'is_flag',
        'dept_id',
        'last_login_at',
        'last_login_ip',
        'last_login_client',
        'last_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->is_admin === self::admin;
    }

    public function isUser()
    {
        return $this->is_admin === self::user;
    }

    public function roleAdmin()
    {
        return $this->is_admin === self::admin || $this->is_role === self::roleAdmin;
    }

    public function roleUser()
    {
        return $this->is_admin === self::admin || $this->is_role === self::roleAdmin || $this->is_role === self::roleUser;
    }


public function isAppPermission()
    {
        if (self::roleAdmin()) {
            return true;
        } else {
            if (Auth::check()) {
                $permiss = DB::table('user_permissions')->where('emp_id', '=', Auth::user()->emp_id)->get();
                if ($permiss->isNotEmpty()) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }
    }

    public function permission_admin()
    {
        if (Auth::check()) {
            $permiss = DB::table('user_permissions')->where('emp_id', '=', Auth::user()->emp_id)->where('level', '=', 1)->get();
            if ($permiss->isNotEmpty()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function manager()
    {
         if (Auth::check()) {
            $permiss = DB::table('user_permissions')->where('emp_id', '=', Auth::user()->emp_id)->whereIn('level', [9,1])->get();
            if ($permiss->isNotEmpty()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    public function productPrice()
    {
         if (Auth::check()) {
            $permiss = DB::table('user_permissions')->where('emp_id', '=', Auth::user()->emp_id)->whereIn('level', [10,1])->get();
            if ($permiss->isNotEmpty()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    public function noProductPrice()
    {
         if (Auth::check()) {
            $permiss = DB::table('user_permissions')->where('emp_id', '=', Auth::user()->emp_id)->where('level', '<>','10')->get();
            if ($permiss->isNotEmpty()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}