<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->text('main_image')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('type');
            $table->text('address')->nullable();
            $table->text('link')->nullable();
            $table->text('record_link')->nullable();
            $table->decimal('duration')->nullable();
            $table->unsignedBigInteger('lector_id');
            $table->unsignedBigInteger('category_id');
            $table->integer('max_participants')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
