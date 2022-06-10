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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->tinyInteger('quantity');
            $table->decimal('value', 9,2)->nullable();
            $table->decimal('final_amount', 9,2);
            $table->string('currency')->nullable()->default(env('DEFAULT_CURRENCY'));

            // Personalized Message
            $table->string('personal_message')->nullable();
            $table->foreignId('message_design_id')->nullable()->constrained();

            // Delivery
            $table->foreignId('delivery_type_id')->nullable()->constrained();
            $table->string('recipient_name')->nullable();
            $table->string('recipient_email')->nullable();
            $table->string('recipient_phone')->nullable();
            $table->string('recipient_address')->nullable();
            $table->string('recipient_city')->nullable();
            $table->string('recipient_state')->nullable();
            $table->unsignedBigInteger('recipient_country_id')->nullable();
            $table->foreign('recipient_country_id')->references('id')->on('countries');
            $table->decimal('delivery_charges')->nullable();
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
        Schema::dropIfExists('order_items');
    }
};
