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
        Schema::create('title_review_service', function (Blueprint $table) {
            $table->foreignId("review_service_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId("title_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string("url");
            $table->float("score")->nullable();
            $table->integer("count")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('title_review_service');
    }
};
