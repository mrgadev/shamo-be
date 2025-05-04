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
        Schema::table('products', function(Blueprint $table) {
            $table->dropColumn('product_categories_id');
            $table->foreignUuid('product_categories_id')->onDelete('cascade');
        });

        Schema::table('product_photos', function(Blueprint $table) {
            $table->dropColumn('id');
            $table->uuid('id')->primary();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function(Blueprint $table) {
            $table->dropColumn('product_categories_id');
            $table->foreignUuid('product_categories_id');
        });

        Schema::table('product_photos', function(Blueprint $table) {
            $table->dropColumn('id');
            $table->uuid('id')->primary();
        });
    }
};
