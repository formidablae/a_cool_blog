<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'title'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at'
    ];

    /**
     * The attributes that are not mass-assignable.
     * 
     * @var array
     */
    protected $guarded = [
        'id', 'user_id', 'created_at'
    ];

    protected $table = 'posts';

    /**
     * relationships
     */
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
