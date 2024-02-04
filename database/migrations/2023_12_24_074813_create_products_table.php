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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained( 'users' )->onDelete( 'cascade' );
            $table->string('name');
            $table->text('description');
            $table->decimal( 'price', 10);
            $table->decimal('sales')->default( 0 );
            $table->boolean( 'is_new' )->default( true );
            $table->timestamp('new_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
