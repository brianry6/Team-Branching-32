<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('Orders', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['Cart_ID']);

            // Drop the unique index
            $table->dropUnique('orders_cart_id_unique');

            // Re-add the foreign key without unique constraint
            $table->foreign('Cart_ID')->references('Cart_ID')->on('Cart')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('Orders', function (Blueprint $table) {
            // Drop the foreign key
            $table->dropForeign(['Cart_ID']);

            // Recreate the unique index
            $table->unique('Cart_ID');

            // Re-add foreign key (with unique index)
            $table->foreign('Cart_ID')->references('Cart_ID')->on('Cart')->onDelete('cascade');
        });
    }
};

