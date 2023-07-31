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
            $table->text('last_name', 60)->after('name')->nullable(false);
            $table->text('phone',20)->after('last_name')->nullable(true);
            $table->enum('profile',['Admin','Driver'])->after('phone')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('profile');
        });
    }
};
