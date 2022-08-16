<?php

namespace Modules\Article\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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

        Model::unguard();

        $this->makeArticleData($faker);
        $this->makeArticleCategoryData($faker);
        $this->makeArticleTagData($faker);
    }

    /**
     * 生成 Article 数据
     */
    protected function makeArticleData(\Faker\Generator $faker)
    {
        $data = [];

        foreach (range(1, 100) as $index) {
            $data[] = [
                'title'         =>  $faker->sentence(),
                'intro'         =>  Str::limit($faker->paragraph, 200),
                'content'       =>  $faker->text(random_int(100, 500))
                                        . '<br><br>' . $faker->text(random_int(100, 500))
                                        . '<br><br>' . $faker->text(random_int(100, 500)),
                'cover'         =>  $faker->imageUrl(480, 360, true),

                'author'        =>  $faker->name(),
                'published_at'  =>  $faker->dateTimeThisMonth(),

                'status'        =>  1,

                'created_at'    =>  $faker->dateTimeThisMonth(),
                'updated_at'    =>  $faker->dateTimeThisMonth(),
            ];
        }

        Article::insert($data);
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
                'slug'          =>  $name,
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
