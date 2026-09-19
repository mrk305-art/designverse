<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('collection_design', function (Blueprint $table) {
            $table->id();

            $table->foreignId('collection_id')
                ->constrained('collections')
                ->cascadeOnDelete();

            $table->foreignId('design_id')
                ->constrained('designs')
                ->cascadeOnDelete();

            $table->timestamps();

            $table->unique([
                'collection_id',
                'design_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collection_design');
    }
};