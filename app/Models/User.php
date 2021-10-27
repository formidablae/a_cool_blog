<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract {
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'picture'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'updated_at'
    ];

    /**
     * The attributes that are not mass-assignable.
     * 
     * @var array
     */
    protected $guarded = [
        'id', 'created_at'
    ];

    /**
     * other attributes
     */
    protected $table = 'users';
    protected $appends = ['full_name'];

    /**
     * obtain full name attribute
     */
    public function getFullNameAttribute(): string {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    /**
     * relationships
     */
    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }
}
