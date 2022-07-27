<?php

namespace Database\Seeders;

use App\Models\Common\Comment;
use App\Models\Common\Thumb;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Modules\Post\Entities\Post;

class CommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = User::select('id')->pluck('id')->toArray();
        $commentIds = Comment::select('id')->pluck('id')->toArray();
        $postIds = Post::select('id')->pluck('id')->toArray();

        Thumb::factory()
            ->count(100)
            ->create(function () use ($userIds, $commentIds, $postIds) {
                $entityId = null;
                $entityClass = Arr::random([
                    Comment::class,
                    Post::class,
                ]);

                if ($entityClass === Comment::class) {
                    $entityId = Arr::random($commentIds);
                } elseif ($entityClass === Post::class) {
                    $entityId = Arr::random($postIds);
                }

                return [
                    'user_id'           =>  Arr::random($userIds),
                    'entity_class'      =>  $entityClass,
                    'entity_id'         =>  $entityId,
                ];
            });
    }
}
