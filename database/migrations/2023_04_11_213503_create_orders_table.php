<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("address");
            $table->string("urlmap");
            $table->string("date");
            $table->unsignedBigInteger('status')->default(0);
            $table->foreignId("ad_id")->references('id')->on('ads')->onDelete('cascade');
            $table->foreignId("user_id")->references('id')->on('users')->onDelete('cascade');
            $table->foreignId("ad_user_id")->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
};
