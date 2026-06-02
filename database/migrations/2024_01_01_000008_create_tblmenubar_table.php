<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tblmenubar', function (Blueprint $table) {
            $table->integer('navid');
            $table->string('name')->nullable();
            $table->string('nav1')->nullable();
            $table->string('nav2')->nullable();
            $table->string('nav3')->nullable();
            $table->string('nav4')->nullable();
            $table->string('nav5')->nullable();
            $table->string('nav6')->nullable();
            $table->string('nav7')->nullable();
            $table->string('nav8')->nullable();
            $table->text('logo')->nullable();
            $table->dateTime('create_at')->nullable();
            $table->dateTime('update_at')->nullable();
            $table->string('whiteTitle')->nullable();
            $table->string('blueTitle')->nullable();
            $table->string('description')->nullable();
            $table->string('sliderImage')->nullable();
            $table->string('btnTitle');
            $table->string('whiteTitle2')->nullable();
            $table->string('blueTitle2')->nullable();
            $table->string('description2')->nullable();
            $table->string('sliderImage2')->nullable();
            $table->string('btnTitle2')->nullable();
            $table->string('whiteTitle3')->nullable();
            $table->string('blueTitle3')->nullable();
            $table->string('description3')->nullable();
            $table->string('sliderImage3')->nullable();
            $table->string('btnTitle3')->nullable();
            $table->primary(['navid', 'btnTitle']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblmenubar');
    }
};
