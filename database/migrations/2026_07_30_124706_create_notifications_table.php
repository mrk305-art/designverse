<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {

            $table->id();

            // Notification kis user ko milegi
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Notification kis user ne generate ki
            $table->foreignId('from_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Notification kis design se related hai
            $table->foreignId('design_id')
                ->nullable()
                ->constrained('designs')
                ->cascadeOnDelete();

            // like, follow, comment
            $table->string('type');

            // Notification ka message
            $table->text('message');

            // Read/unread
            $table->boolean('is_read')->default(false);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

