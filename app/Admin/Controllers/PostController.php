<?php

namespace App\Admin\Controllers;

use App\Models\Post\Post as Post;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class PostController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '动态';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Post());

        $grid->column('id', 'ID');
        $grid->column('status', '状态')->select(Post::$statuses);
        $grid->column('user.nickname', '作者');
        $grid->column('content', '内容')->expand(function ($model) {
            $comments = $model->comments()->take(10)->latest()->get()->map(function ($comment) {
                return $comment->only('id', 'user.nickname', 'content', 'created_at');
            });

            return new Table(['ID', '作者', '内容', '发布时间'], $comments->toArray());
        });
        $grid->column('image_num', '图片数量');
        $grid->column('read_num', '阅读数');
        $grid->column('favorite_num', '喜爱数');
        $grid->column('comment_num', '评论数');
        $grid->column('thumb_up_num', '点赞数');
        $grid->column('created_at', '发布时间');

        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Post::findOrFail($id));

        $show->field('id', 'Id');
        $show->field('user_id', 'User id');
        $show->field('content', 'Content');
        $show->field('read_num', 'Read num');
        $show->field('favorite_num', 'Favorite num');
        $show->field('comment_num', 'Comment num');
        $show->field('thumb_up_num', 'Thumb up num');
        $show->field('thumb_down_num', 'Thumb down num');
        $show->field('status', 'Status');
        $show->field('created_at', 'Created at');
        $show->field('updated_at', 'Updated at');
        $show->field('deleted_at', 'Deleted at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Post());

        $form->number('user_id', 'User id');
        $form->textarea('content', 'Content');
        $form->number('read_num', 'Read num');
        $form->number('favorite_num', 'Favorite num');
        $form->number('comment_num', 'Comment num');
        $form->number('thumb_up_num', 'Thumb up num');
        $form->number('thumb_down_num', 'Thumb down num');
        $form->switch('status', 'Status');

        return $form;
    }
}
