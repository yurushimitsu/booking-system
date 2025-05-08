<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('agent_id')->unique();
            $table->foreign('agent_id')->references('account_no')->on('accounts');
            $table->string('agent_name');
            $table->string('agent_email');
            $table->foreign('agent_email')->references('account_email')->on('accounts');
            $table->string('meeting_link');
            $table->string('country');
            $table->string('profile_picture')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
