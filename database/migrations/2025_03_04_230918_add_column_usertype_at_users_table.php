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
        if(Schema::hasTable('users')){
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('usertype_id')->after('city');
                $table->foreign('usertype_id')->references('id')->on('usertypes')->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasTable('users')){
            Schema::table('users', function (Blueprint $table) {
                $table->dropConstrainedForeignId('usertype_id');
            });
        }
    }
};
