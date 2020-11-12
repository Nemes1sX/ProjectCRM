<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('status');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('project_id')->references('id')->on('projects')
                    ->onCascade('delete');
           /* $table->foreignId('company_id')->references('id')->on('companies')
                    ->onCascade('delete');
            $table->foreignId('user_id')->references('id')->on('users')
                    ->onCascade('delete');*/

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
