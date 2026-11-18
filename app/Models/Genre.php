<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    /**
     * マスアサインメント可能な属性を定義する。
     */
    protected $fillable = [
        'name',
    ];

    /**
     * 書籍とのリレーション（多対多）
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_genre')
            ->withTimestamps();
    }
}
