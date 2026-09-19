<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_activities', function (Blueprint $table) {

            $table->id();

            // User jis ki activity hai
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Activity type
            $table->string('type');

            // Activity message
            $table->string('message');

            // Optional related record
            $table->unsignedBigInteger('design_id')->nullable();

            // Read / unread
            $table->boolean('is_read')->default(false);

            $table->timestamps();


            // Useful indexes
            $table->index('type');
            $table->index('is_read');
            $table->index('created_at');

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('admin_activities');
    }
};