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
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->foreignUuid('user_id')->onDelete('cascade')->nullable()->change();
            $table->foreignUuid('product_id')->onDelete('cascade')->nullable()->change();
            $table->foreignUuid('transaction_id')->onDelete('cascade')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_items', function (Blueprint $table) {
            $table->foreignUuid('user_id')->onDelete('cascade')->nullable(false)->change();
            $table->foreignUuid('product_id')->onDelete('cascade')->nullable(false)->change();
            $table->foreignUuid('transaction_id')->onDelete('cascade')->nullable(false)->change();
        });
    }
};
