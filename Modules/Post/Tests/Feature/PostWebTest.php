<?php

namespace Modules\Post\Tests\Feature;

use Modules\Post\Entities\Post;
use Tests\TestCase;

class PostWebTest extends TestCase
{
    /**
     * Post routes
     */
    public function testPostRoutes()
    {
        $this->get(route('web.posts.index'))->assertOk();

        if ($post = Post::inRandomOrder()->first()) {
            $this->get(route('web.posts.show', $post))->assertOk();
        } else {
            $this->get(route('web.posts.show', 1))->assertNotFound();
        }
    }
}
