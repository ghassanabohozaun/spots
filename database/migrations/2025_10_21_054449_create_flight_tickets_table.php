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
        Schema::create('flight_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('details');
            $table->decimal('price', 8, 3);
            $table->foreignId('from_country_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('from_governorate_id')->constrained('governorates')->cascadeOnDelete();
            $table->foreignId('to_country_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('to_governorate_id')->constrained('governorates')->cascadeOnDelete();
            $table->boolean('status')->default(1);
            $table->string('photo');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_tickets');
    }
};
