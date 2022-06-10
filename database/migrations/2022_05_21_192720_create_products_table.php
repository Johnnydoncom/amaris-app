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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subheading')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->json('redemption_information')->nullable();
            $table->string('redemption_type')->nullable();
            $table->json('redemption_country_ids')->nullable();
            $table->enum('product_type',['gift_card','default'])->default('default');
            $table->decimal('regular_price', 9,2)->nullable(); // normal Price
            $table->decimal('sales_price', 9,2)->nullable(); // normal Price
            $table->boolean('featured')->default(false);
            $table->foreignId('platform_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('country_id')->nullable()->constrained()->cascadeOnDelete();
            $table->boolean('manage_stock')->default(false);
            $table->bigInteger('stock_quantity')->nullable();
            $table->bigInteger('views_count')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
