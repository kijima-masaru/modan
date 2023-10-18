<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content'
    ];

    // 外部キーであるuser_idの設定
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Likeとの関連を定義(1対0もしくは多)
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Commentとの関連を定義(1対0もしくは多)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
