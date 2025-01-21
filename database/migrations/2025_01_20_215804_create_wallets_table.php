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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('wallet_type_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('balance', 15, 2)->default(0);
            $table->string('wallet_address', 11)->unique();
            $table->timestamps();
    
            // $table->unique(['user_id', 'name']); // Name must be unique for each user
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
