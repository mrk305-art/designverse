<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('follows', function (Blueprint $table) {

            $table->id();

            // Jo user follow kar raha hai
            $table->foreignId('follower_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Jis user/designer ko follow kiya ja raha hai
            $table->foreignId('following_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

            // Same user ko dobara follow nahi kar sakte
            $table->unique([
                'follower_id',
                'following_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};

