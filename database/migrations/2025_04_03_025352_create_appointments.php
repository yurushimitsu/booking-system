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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('agent_id');
            $table->foreign('agent_id')->references('agent_id')->on('agents');
            $table->string('appointment_type');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('name');
            $table->string('email');
            $table->string('contact');
            $table->string('notes')->nullable();
            $table->string('status');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
