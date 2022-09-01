<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index()->unsigned()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('title')->comment('活动标题');
            $table->string('cover')->comment('活动封面');
            $table->string('intro')->nullable()->comment('活动简介');
            $table->text('content')->comment('活动内容');

            $table->string('address_name')->comment('活动地址名称');
            $table->string('address_full')->comment('活动详情地址');
            $table->string('latitude')->comment('活动地址纬度');
            $table->string('longitude')->comment('活动地址经度');
            $table->dateTime('started_at')->comment('活动开始时间');
            $table->dateTime('ended_at')->comment('活动结束时间');

            $table->float('price')->comment('活动价格');
            $table->integer('total_ticket_num')->comment('总活动票数');
            $table->integer('surplus_ticket_num')->comment('剩余活动票数');

            $table->integer('thumb_up_num')->default(0)->comment('活动点赞人数');
            $table->integer('comment_num')->default(0)->comment('活动点赞人数');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
