<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('customer_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->decimal('quantity',$precision=8,$scale=2)->nullable();
            $table->decimal('value',$precision=8,$scale=2)->nullable();
            $table->string('type')->nullable();
            $table->boolean('stock')->default(1)->comment('1:Active,0:Inactive')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
