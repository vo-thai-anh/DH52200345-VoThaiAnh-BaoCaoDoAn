<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {

            // product_id vừa là PK vừa là FK
            $table->Integer('id')->primary();
            $table->integer('product_id');
            $table->integer('quantity')->default(0);
            $table->integer('min_stock')->default(0);
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('product_id')
                    ->references('product_id')
                    ->on('products')
                    ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};