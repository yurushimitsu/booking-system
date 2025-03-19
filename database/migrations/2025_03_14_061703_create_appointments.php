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
            $table->unsignedInteger('agent_no');
            $table->foreign('agent_no')->references('account_no')->on('accounts');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_contact');
            $table->string('client_notes')->nullable();
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
