<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAssistantsSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\Config::get( 'assistant-manager.user_assistants_table' ), function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')
                ->comment('User master account ID');
            $table->unsignedInteger('assistant_id')
                ->comment('User sub account ID');
            $table->unsignedInteger('group_id')
                ->nullable()
                ->comment('User group ID');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('assistant_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\Config::get( 'assistant-manager.user_assistants_table' ));
    }
}
