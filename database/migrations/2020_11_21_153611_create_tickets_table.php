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
            $table->string('title', 100);
            $table->string('description');
            $table->foreignId('manager_id');
            $table->foreignId('developer_id');
            $table->enum('priority', ['low', 'medium', 'high'])->default('low');
            $table->enum('status', ['assigned', 'in_progress', 'submitted', 'completed'])->default('assigned');
            $table->timestamp('due_on');
            $table->timestamps();

            $table->foreign('manager_id')
                ->references('id')
                ->on('users');
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
