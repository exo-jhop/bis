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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->date('birth_date')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('occupation')->nullable();
            $table->boolean('is_voter')->default(false);
            $table->string('email')->nullable();
            $table->string('phone_number', 11)->nullable();
            $table->foreignId('barangay_id')->nullable()->constrained();
            $table->string('street')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
