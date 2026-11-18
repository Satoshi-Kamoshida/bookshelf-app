<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * マスアサインメント可能な属性を定義する。
     */
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'published_date',
        'description',
        'image_url',
    ];

    /**
     * 自分が登録した書籍（１対多）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * お気に入り登録した書籍（多対多）
     */
    public function favoritedusers()
    {
        return $this->belongsToMany(User::class, 'favorites')
            ->withTimestamps();
    }

    /**
     * レビューを投稿された書籍（１対多）
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * ジャンルとのリレーション（多対多）
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class)
            ->withTimestamps();
    }
}
