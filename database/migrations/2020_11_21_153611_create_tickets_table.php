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
            $table->foreignId('project_id');
            $table->foreignId('developer_id');
            $table->string('title', 100);
            $table->string('description');
            $table->enum('priority', ['low', 'medium', 'high'])->default('high');
            $table->enum('status', ['assigned', 'in_progress', 'submitted', 'completed'])->default('assigned');
            $table->timestamp('due_on');
            $table->timestamps();

            $table->foreign('project_id')
                ->references('id')
                ->on('projects');
            $table->foreign('developer_id')
                ->references('id')
                ->on('users');
        });

        Schema::create('developer_ticket', function (Blueprint $table) {
            $table->primary(['ticket_id', 'developer_id']);
            $table->foreignId('ticket_id');
            $table->foreignId('developer_id');
            $table->timestamps();

            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets');

            $table->foreign('developer_id')
                ->references('id')
                ->on('users');
        });

        Schema::create('project_ticket', function (Blueprint $table) {
            $table->primary(['project_id', 'ticket_id']);
            $table->foreignId('project_id');
            $table->foreignId('ticket_id');
            $table->timestamps();

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developer_ticket');
        Schema::dropIfExists('project_ticket');
        Schema::dropIfExists('tickets');
    }
}
