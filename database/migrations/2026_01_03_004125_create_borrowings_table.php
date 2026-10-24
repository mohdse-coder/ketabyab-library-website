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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // کاربر
            $table->foreignId('book_id')->constrained()->onDelete('cascade'); // کتاب
            $table->timestamp('borrowed_at')->nullable();  // زمان امانت
            $table->timestamp('due_date')->nullable();     // تاریخ تحویل
            $table->timestamp('returned_at')->nullable(); // زمان برگشت
            $table->timestamps(); // created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
