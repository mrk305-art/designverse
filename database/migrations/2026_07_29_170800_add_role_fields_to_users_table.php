<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->enum('role', ['admin', 'designer', 'client'])->default('designer');

            $table->string('username')->unique()->after('name');

            $table->string('profile_photo')->nullable();

            $table->boolean('is_verified')->default(false);

            $table->boolean('status')->default(true);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'role',
                'username',
                'profile_photo',
                'is_verified',
                'status'
            ]);

        });
    }
};
