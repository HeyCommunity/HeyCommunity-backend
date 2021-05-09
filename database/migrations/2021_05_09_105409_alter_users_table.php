<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->timestamp('last_active_at')->nullable()->after('remember_token')->comment('最后活跃时间');
            $table->json('wx_user_info')->nullable()->after('ugc_safety_level')->comment('微信用户信息');
            $table->integer('unread_notice_num')->default(0)->after('ugc_safety_level')->comment('未读通知数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['last_active_at', 'wx_user_info', 'unread_notice_num']);
        });
    }
}
