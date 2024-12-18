<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade'); 
            $table->foreignId('recipient_id')
                    ->nullable()->references('id')->on('users')
                    ->onDelete('set null'); 
            $table->foreignId('group_id')
                  ->nullable()->references('id')
                  ->on('groups')
                  ->onDelete('set null');; 
            $table->text('content'); 
            $table->enum('status', ['sent', 'delivered', 'read'])->default('sent'); 
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
        Schema::dropIfExists('messages');
    }
};
