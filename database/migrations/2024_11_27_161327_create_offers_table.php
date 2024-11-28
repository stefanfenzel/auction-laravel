<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('auction_id')->constrained('auctions')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('bid_amount', 10, 2)->nullable(false);
            $table->dateTime('bid_time')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
