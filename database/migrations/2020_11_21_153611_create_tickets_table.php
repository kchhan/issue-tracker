<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable();
            $table->foreignId('developer_id')->nullable();
            $table->string('title', 100);
            $table->text('description');
            $table->enum('type', ['bug', 'feature', 'other'])->default('bug');
            $table->enum('priority', ['low', 'medium', 'high'])->default('high');
            $table->enum('status', ['assigned', 'in_progress', 'submitted', 'completed'])->default('assigned');
            $table->timestamp('duedate');
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
        Schema::dropIfExists('tickets');
    }
}
