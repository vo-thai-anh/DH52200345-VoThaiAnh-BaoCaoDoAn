<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id('payment_id');

            $table->Integer('order_id');

            $table->Integer('user_id');

            $table->decimal('amount', 12, 2);
            $table->string('payment_method', 50);
            $table->string('status', 50)->default('pending');
            $table->text('note')->nullable();

            $table->timestamps();

            $table->foreign('order_id')
                    ->references('order_id')
                    ->on('order_tables')
                    ->onDelete('cascade');

            $table->foreign('user_id')
                    ->references('user_id')
                    ->on('users')
                    ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
