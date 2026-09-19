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
        Schema::create('profiles', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->text('bio')->nullable();

            $table->string('country')->nullable();

            $table->string('city')->nullable();

            $table->string('website')->nullable();

            $table->string('github')->nullable();

            $table->string('linkedin')->nullable();

            $table->string('behance')->nullable();

            $table->string('dribbble')->nullable();

            $table->string('facebook')->nullable();

            $table->string('instagram')->nullable();

            $table->string('profile_photo')->nullable();

            $table->string('cover_photo')->nullable();

            $table->string('experience')->nullable();

            $table->text('skills')->nullable();

            $table->boolean('availability')->default(true);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
