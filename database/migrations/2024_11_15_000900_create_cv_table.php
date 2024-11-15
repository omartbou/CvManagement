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
        Schema::create('cv', function (Blueprint $table) {
            $table->id();
            $table->string('FilePath');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('language_id');
            $table->date('due_date');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('job')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('language')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cv');
    }
};
