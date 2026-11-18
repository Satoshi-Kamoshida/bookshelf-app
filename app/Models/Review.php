<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * マスアサインメント可能な属性を定義する。
     */
    protected $fillable = [
        'rating',
        'comment',
    ];

    /**
     * ユーザーとのリレーション（１対多）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * いいねしたユーザーとのリレーション（多対多）
     */
    public function likedusers()
    {
        return $this->belongsToMany(User::class, 'review_likes')
            ->withTimestamps();
    }

    /**
     * 書籍とのリレーション（１対多）
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
