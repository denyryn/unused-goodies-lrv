<?php

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('transaction_id', 255)->nullable()->index();
            $table->enum('payment_method', array_column(PaymentMethodEnum::cases(), 'value'));
            $table->enum('payment_status', array_column(PaymentStatusEnum::cases(), 'value'))->default(PaymentStatusEnum::PENDING->value)->index();
            $table->decimal('amount', 10, 2)->unsigned();
            $table->decimal('refund_amount', 10, 2)->unsigned()->default(0);
            $table->json('gateway_response')->nullable();
            $table->string('failure_reason')->nullable();
            $table->timestamps(3);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
