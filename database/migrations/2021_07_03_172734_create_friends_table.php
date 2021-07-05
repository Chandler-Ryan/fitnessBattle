<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('friend_id');
			$table->timestamps();
			$table->primary(['user_id', 'friend_id']);
			$table->foreign('user_id', 'user_friend_fk')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('friend_id', 'friend_user_fk')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friends');
    }
}
