<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'kaban';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('executors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedBigInteger('user_id');
            $table->unsignedTinyInteger('role_id');
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->time('time_spent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('executors');
    }
};
