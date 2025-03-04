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
        Schema::create('usertype_permission', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usertype_id');
            $table->unsignedBigInteger('user_permission_id');

            $table->foreign('usertype_id')->references('id')->on('usertypes')->cascadeOnDelete();
            $table->foreign('user_permission_id')->references('id')->on('user_permissions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usertype_permission');
    }
};
