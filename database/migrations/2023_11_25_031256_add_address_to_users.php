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
        Schema::table('users', function (Blueprint $table) {
            $table->text('address')->after('remember_token');
            $table->integer('phone_number')->after('address');
            $table->string('simcard_number')->after('phone_number');
            $table->integer('role_id')->after('simcard_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('phone_number');
            $table->dropColumn('simcard_number');
            $table->dropColumn('role_id');
        });
    }
};
