<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['birthday'];

    /**
     * Whether the user is a super admin or not
     *
     * @return boolean
     */
    public function isSuperAdmin()
    {
        return $this->role == 'administrator';
    }

    /**
     * Whether the user is an admin or not
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return in_array($this->role, ['administrator', 'librarian']);
    }

    /** Relationships **/

    public function books()
    {
        return $this->belongsToMany(Book::class, 'loans', 'user_id', 'book_id')
            ->withTimestamps();
    }

    public function loans()
    {
        return $this->hasMany(Loan::class)
            ->with('book')
            ->where('status', 'active');
    }
}
