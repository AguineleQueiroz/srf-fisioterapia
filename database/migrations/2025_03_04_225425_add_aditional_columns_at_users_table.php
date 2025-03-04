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
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('cpf')->unique()->nullable()->after('password');
                $table->string('phone', 16)->nullable()->after('cpf');
                $table->enum('professional_type', ['admin', 'manager','basic', 'primary', 'secondary', 'other'])->nullable()->after('phone');
                $table->string('document', 35)->nullable()->after('professional_type'); // Professional registration document
                $table->string('address')->nullable()->after('document');
                $table->string('city')->nullable()->after('address');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn([
                    'cpf',
                    'phone',
                    'professional_type',
                    'document',
                    'address',
                    'city'
                ]);
            });
        }
    }
};
