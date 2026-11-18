<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ユーザーを全件取得
        $users = User::all();

        // レビューを全件取得
        $reviews = Review::all();

        // レビューごとに処理
        foreach ($reviews as $review) {

            // いいね件数を0〜3件でランダムに決定
            $count = fake()->numberBetween(0, 3);

            // 投稿者本人を除外し、ランダムにユーザーを選択
            $selectedUsers = $users->where('id', '!=', $review->user_id)->shuffle()->take($count);

            // ユーザーIDを配列に変換
            $reviewLikeUserIds = $selectedUsers->pluck('id')->toArray();

            // レビューと複数のユーザーを同期
            $review->likedusers()->syncWithoutDetaching($reviewLikeUserIds);

        }
    }
}
