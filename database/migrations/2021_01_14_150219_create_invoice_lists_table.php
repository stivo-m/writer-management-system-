<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")->constrained('orders');
            $table->foreignId("writer_id")->constrained('users');
            $table->string("amount");
            $table->string("pay_status");
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
        Schema::dropIfExists('invoice_lists');
    }
}