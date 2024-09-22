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
        Schema::create('trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(USer::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->string('mode')->default('ingoing');
            $table->string('category')->default('unset');
            $table->string('description')->default('unset');
            $table->integer('amount')->default(0);
            $table->date('date')->default('2004/07/07');         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking');
    }
};
