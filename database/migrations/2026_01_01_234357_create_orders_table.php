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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // کاربر
        $table->foreignId('book_id')->constrained()->onDelete('cascade'); // کتاب
        $table->date('borrowed_at');
        $table->date('returned_at')->nullable(); // اگر بازگشت داده نشده باشد null است
        $table->enum('status', ['borrowed','returned','late'])->default('borrowed');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
