<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('garage_id')->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('technician_id')->nullable()->constrained('users')->nullOnDelete();
            
            $table->string('vehicle_brand');
            $table->string('vehicle_model');
            $table->integer('vehicle_year');
            $table->string('vehicle_plate')->nullable();
            
            $table->string('glazing_type');
            $table->string('intervention_type');
            $table->text('description')->nullable();
            
            $table->string('address');
            $table->string('city');
            $table->string('postal_code');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            
            $table->date('preferred_date');
            $table->string('preferred_time_slot')->nullable();
            
            $table->integer('price_offer');
            $table->string('status')->default('draft');
            
            $table->timestamp('published_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            
            $table->timestamps();

            $table->index('status');
            $table->index('garage_id');
            $table->index('technician_id');
            $table->index(['latitude', 'longitude']);
            $table->index('preferred_date');
        });

        Schema::create('mission_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('mission_id')->constrained()->cascadeOnDelete();
            $table->string('type');
            $table->string('path');
            $table->string('original_name');
            $table->integer('size');
            $table->timestamps();

            $table->index(['mission_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mission_photos');
        Schema::dropIfExists('missions');
    }
};
