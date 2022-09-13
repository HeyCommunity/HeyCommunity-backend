<?php

namespace Modules\Article\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Modules\Article\Entities\Article;
use Modules\Article\Entities\ArticleCategory;
use Modules\Article\Entities\ArticleCategoryMap;
use Modules\Article\Entities\ArticleTag;
use Modules\Article\Entities\ArticleTagMap;

class ArticleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));
        $faker->addProvider(new \SupGeekRod\FakerZh\ZhCnDataProvider($faker));

        $this->makeArticleData($faker);
        $this->makeArticleCategoryData($faker);
        $this->makeArticleTagData($faker);
    }

    /**
     * 生成 Article 数据
     */
    protected function makeArticleData(\Faker\Generator $faker)
    {
        $users = User::inRandomOrder()->limit(20)->get();
        if ($users->empty()) {
            $users = User::factory()->count(50)->create();
        }

        Article::factory()
            ->state(new Sequence(
                fn () => ['user_id' => $faker->randomElement($users)],
            ))
            ->count(50)
            ->create();
    }

    /**
     * 生成 ArticleCategory 数据
     */
    protected function makeArticleCategoryData(\Faker\Generator $faker)
    {
        $articleCategoryData = [];
        foreach (range(1, 5) as $index) {
            $articleCategoryData[] = [
                'sort'          =>  $index + 1,
                'slug'          =>  'slug-' . ($index + 1),
                'name'          =>  $faker->monthName(),
                'description'   =>  $faker->sentence(),

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }
        ArticleCategory::insert($articleCategoryData);

        $articleIds = Article::pluck('id')->toArray();
        $articleCategoryIds = ArticleCategory::pluck('id')->toArray();

        $articleCategoryMapData = [];
        foreach ($articleIds as $articleId) {
            $articleCategoryMapData[] = [
                'article_id'    =>  $articleId,
                'category_id'   =>  $faker->randomElement($articleCategoryIds),
            ];
        }
        ArticleCategoryMap::insert($articleCategoryMapData);
    }

    /**
     * 生成 ArticleTag 数据
     */
    protected function makeArticleTagData(\Faker\Generator $faker)
    {
        $articleTagData = [];
        foreach (range(1, 10) as $index) {
            $name = $faker->colorName();

            $articleTagData[] = [
                'sort'          =>  $index,
                'slug'          =>  \Faker\Factory::create('en_US')->word(),
                'name'          =>  $name,
                'description'   =>  $faker->sentence(),

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }
        ArticleTag::insert($articleTagData);

        $articleIds = Article::pluck('id')->toArray();
        $articleTagIds = ArticleTag::pluck('id')->toArray();

        $articleTagData = [];
        foreach ($articleIds as $articleId) {
            foreach (range(1, random_int(1, 3)) as $index) {
                $articleTagData[] = [
                    'article_id'    =>  $articleId,
                    'tag_id'        =>  $faker->randomElement($articleTagIds),
                ];
            }
        }
        ArticleTagMap::insert($articleTagData);
    }
}
