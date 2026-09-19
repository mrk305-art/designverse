<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('design_saves', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('design_id')
                ->constrained('designs')
                ->cascadeOnDelete();

            $table->timestamps();

            // Same user same design ko
            // multiple times save nahi kar sakta.
            $table->unique([
                'user_id',
                'design_id'
            ]);

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('design_saves');
    }
};

