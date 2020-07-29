<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoteablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voteables', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->comment('Which user casted a vote');
            $table->unsignedInteger('voteable_id')->comment('Either a question or answer ID');
            $table->string('voteable_type')->comment('Types include: question or answer');
            $table->tinyInteger('vote')->comment('Two possible values (1 for vote up, -1 for vote down');
            $table->timestamps();
            $table->unique(['user_id', 'voteable_id', 'voteable_type'])
                ->comment('Allow user to only vote once per question or answer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voteables');
    }
}
