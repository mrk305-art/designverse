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
        Schema::create('reports', function (Blueprint $table) {

            $table->id();

            // User who submitted the report
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Reported design
            $table->foreignId('design_id')
                ->nullable()
                ->constrained('designs')
                ->cascadeOnDelete();

            // Report reason
            $table->string('reason');

            // Optional explanation
            $table->text('description')->nullable();

            // pending / reviewed / resolved / dismissed
            $table->enum('status', [
                'pending',
                'reviewed',
                'resolved',
                'dismissed'
            ])->default('pending');

            // Admin response/action
            $table->text('admin_note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};