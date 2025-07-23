<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('academy_rank')->default('Cadet');
        $table->integer('academy_points')->default(0);
        $table->string('academy_task')->nullable();
        $table->integer('academy_progress')->default(0);
    });
}

