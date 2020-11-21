<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('description');
            $table->foreignId('manager_id')->nullable();
            $table->enum('type', ['bug', 'feature', 'other'])->default('bug');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['assigned', 'in_progress', 'submitted', 'completed'])->default('assigned');
            $table->timestamp('due_on');
            $table->timestamps();

            $table->foreign('manager_id')
                ->references('id')
                ->on('users');
        });

        Schema::create('manager_project', function (Blueprint $table) {
            $table->primary(['project_id', 'manager_id']);
            $table->foreignId('project_id');
            $table->foreignId('manager_id');
            $table->timestamps();

            $table->foreign('project_id')
                ->references('id')
                ->on('projects');

            $table->foreign('manager_id')
                ->references('id')
                ->on('users');
        });

        Schema::create('developer_project', function (Blueprint $table) {
            $table->primary(['project_id', 'developer_id']);
            $table->foreignId('project_id');
            $table->foreignId('developer_id');
            $table->timestamps();

            $table->foreign('project_id')
                ->references('id')
                ->on('projects');

            $table->foreign('developer_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
