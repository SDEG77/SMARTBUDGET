<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->double('food')->default(0.00);
            $table->double('rent')->default(0.00);
            $table->double('transportation')->default(0.00);
            $table->double('loan')->default(0.00);
            $table->double('shopping')->default(0.00);
            $table->double('mobile')->default(0.00);
            $table->double('savings')->default(0.00);
            $table->double('school')->default(0.00);
            $table->double('others')->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allocations');
    }
};
