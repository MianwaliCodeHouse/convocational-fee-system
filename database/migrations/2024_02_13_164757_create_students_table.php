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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cnic')->unique();
            $table->string('registerationNo')->unique();
            $table->string('name');
            $table->string('fatherName');
            $table->string('email');
            $table->string('dob');
            $table->string('gender');
            $table->string('department');
            $table->string('mobileNo');
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('slipImage')->nullable();
            $table->string('certificate')->nullable();
            $table->integer('verifyMobileNo')->default(0);
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
