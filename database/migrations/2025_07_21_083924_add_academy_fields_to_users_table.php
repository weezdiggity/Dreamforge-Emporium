<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('academy_rank')->default('Cadet');
            $table->integer('academy_points')->default(0);
            $table->string('academy_task')->nullable();
            $table->integer('academy_progress')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'academy_rank',
                'academy_points',
                'academy_task',
                'academy_progress',
            ]);
        });
    }
};
