<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_members', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->index()->unsigned()->nullable()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('activity_id')->index()->unsigned()->nullable()->comment('Activity ID');
            $table->foreign('activity_id')->references('id')->on('activities');

            /* TODO: 后期对接付款时再添加
            $table->tinyInteger('is_paid')->default(0)->comment('是否完成支付');
            $table->float('price_paid')->comment('支付价格');
            $table->datetime('paid_at')->nullable()->comment('支付时间');
            $table->string('payment_id')->nullable()->comment('支付订单编号');
            */

            $table->tinyInteger('status')->default(0)->comment('Status');

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
        Schema::dropIfExists('activity_members');
    }
}
