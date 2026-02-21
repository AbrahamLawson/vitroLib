<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mission_declines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('mission_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('technician_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('declined_at');

            $table->unique(['mission_id', 'technician_id']);
            $table->index('technician_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mission_declines');
    }
};
