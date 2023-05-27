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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')
                ->references('id')
                ->on('tasks')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('team_id');
            $table->string('name', 63);
            $table->boolean('is_on_kanban');
            $table->boolean('is_completed');
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->date('planned_start_date');
            $table->date('planned_final_date');
            $table->date('deadline')->nullable();
            $table->date('completed_at')->nullable();
            $table->string('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
