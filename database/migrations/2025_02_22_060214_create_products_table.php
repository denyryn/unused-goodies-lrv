<?php

use App\Enums\ProductStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained();
            $table->string('name')->index();
            $table->string('slug', 255)->unique();
            $table->string('sku')->nullable()->unique();
            $table->enum('status', array_column(ProductStatusEnum::cases(), 'value'))->default('active')->index();
            $table->unsignedInteger('stock');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->unsigned();
            $table->timestamps(3);
            $table->softDeletes();
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
