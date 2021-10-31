<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content'
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
        'id', 'user_id', 'created_at', 'post_id'
    ];
    
    /**
     * other attributes
     */
    protected $table = 'comments';
    protected $with = 'user';

    /**
     * relationships
     */
    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
