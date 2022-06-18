<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->decimal('grand_total', 9,2);
            $table->unsignedInteger('item_count');
            $table->decimal('shipping_charges')->nullable();
            $table->string('currency')->nullable()->default(env('DEFAULT_CURRENCY'));
            $table->unsignedBigInteger('delivery_address_id')->nullable();
            $table->decimal('taxes')->nullable();
            $table->foreignId('user_id')->constrained();

            $table->text('notes')->nullable();
            $table->tinyInteger('payment_status')->default(\App\Enums\PaymentStatus::PENDING);
            $table->enum('status', array_keys(config('giftcard.orderstatus')))->default('pending');

            $table->string('discount_code')->nullable();
            $table->enum('payment_method', ['paystack', 'stripe', 'cash'])->default('paystack');
            $table->string('payment_reference')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
