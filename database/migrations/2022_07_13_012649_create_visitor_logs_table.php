<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->index()->unsigned()->nullable()->comment('User ID');
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('route_type', 30)->index()->nullable()->comment('路由类型');
            $table->string('route_name', 50)->index()->nullable()->comment('路由名称');

            $table->smallInteger('response_status_code')->comment('返回状态码');
            $table->string('request_method', 10)->comment('请求方法');
            $table->string('request_path')->comment('请求路径');
            $table->string('request_uri')->comment('请求 URI');
            $table->string('request_url')->comment('请求 URL');
            $table->string('request_domain')->comment('请求域名');
            $table->string('referer_url')->nullable()->comment('来源 URL');

            $table->string('visitor_ip', 50)->comment('访客 IP');
            $table->string('visitor_ip_locale', 20)->comment('访客 IP 归属城市或国家');
            $table->json('visitor_ip_info')->comment('访客 IP 信息');

            $table->string('visitor_agent_device', 20)->nullable()->comment('访客设备');
            $table->enum('visitor_agent_device_type', ['desktop', 'tablet', 'phone'])->nullable()->comment('访客设备类型');
            $table->json('visitor_agent_info')->nullable()->comment('访客设备信息');

            $table->json('request_data')->nullable()->comment('Laravel Request Object');

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
        Schema::dropIfExists('visitor_logs');
    }
}
