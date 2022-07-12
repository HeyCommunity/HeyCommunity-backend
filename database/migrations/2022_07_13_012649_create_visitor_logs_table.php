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

            $table->string('type')->nullable();
            $table->string('route_name')->nullable();

            $table->string('request_path');
            $table->string('request_uri', 1000);
            $table->string('request_url', 1000);

            $table->string('visitor_ip');
            $table->string('visitor_terminal')->nullable();

            $table->string('http_host');
            $table->string('http_user_agent')->nullable();

            $table->json('request_get_data')->nullable();
            $table->json('request_post_data')->nullable();
            $table->json('request_cookies')->nullable();
            $table->json('request_headers')->nullable();

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
