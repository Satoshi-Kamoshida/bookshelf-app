<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ユーザーを全件取得
        $users = User::all();

        // 書籍を全件取得
        $books = Book::all();

        // ユーザーごとのお気に入り件数
        $favoriteCounts = [
            3, 4, 3, 5, 3,
        ];

        // ユーザーごとに処理
        foreach ($users as $index => $user) {

            // お気に入り件数を取得
            $count = $favoriteCounts[$index];

            // 書籍をランダムに選択し、指定件数分取得
            $selectedBooks = $books->shuffle()->take($count);

            // 書籍IDを配列に変換
            $favoriteBookIds = $selectedBooks->pluck('id')->toArray();

            // ユーザーと複数の書籍を同期
            $user->favorites()->syncWithoutDetaching($favoriteBookIds);

        }
    }
}
