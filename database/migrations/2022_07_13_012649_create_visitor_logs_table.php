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

            $table->string('route_type', 30)->index()->nullable();
            $table->string('route_name', 50)->index()->nullable();

            $table->string('request_path');
            $table->string('request_uri');
            $table->string('request_url');
            $table->string('request_domain');
            $table->string('request_method', 10);

            $table->string('visitor_ip', 50);
            $table->string('visitor_ip_locale', 20);
            $table->json('visitor_ip_info');

            $table->string('visitor_agent_device', 20)->nullable();
            $table->enum('visitor_agent_device_type', ['desktop', 'tablet', 'phone'])->nullable();
            $table->json('visitor_agent_info')->nullable();

            /*
            $table->string('visitor_device', 20)->nullable();
            $table->string('visitor_platform', 20)->nullable();
            $table->string('visitor_browser', 20)->nullable();
            $table->string('visitor_language', 10)->nullable();
            */

            $table->json('request_data')->nullable();

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
