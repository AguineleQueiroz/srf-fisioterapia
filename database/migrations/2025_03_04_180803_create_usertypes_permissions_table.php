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
        if (!Schema::hasTable('usertypes_permissions')) {
            Schema::create('usertypes_permissions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_type_id');
                $table->unsignedBigInteger('user_permission_id');

                $table->foreign('user_type_id')->references('id')->on('user_types')->cascadeOnDelete();
                $table->foreign('user_permission_id')->references('id')->on('user_permissions')->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('usertypes_permissions')) {
            Schema::dropIfExists('usertypes_permissions');
        }
    }
};
