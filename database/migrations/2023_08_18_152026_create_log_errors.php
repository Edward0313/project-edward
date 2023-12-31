<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogErrors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_errors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->default(0)->comment('使用者ID');
            $table->text('exception')->nullable();
            $table->text('message')->nullable();
            $table->integer('line')->nullable();
            $table->json('trace')->nullable();
            $table->string('method')->nullable();
            $table->json('params')->nullable();
            $table->text('url')->nullable();
            $table->text('user_agent')->nullable();
            $table->json('header')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_errors');
    }
}
