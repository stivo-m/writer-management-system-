<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->longText("instructions");
            $table->string("title");
            $table->string("format");
            $table->string("sources");
            $table->string("spacing");
            $table->string("pages");
            $table->string("cpp")->default("250");
            $table->string("slides")->nullable();
            $table->string("files")->nullable();
            $table->string("deadline");
            $table->foreignId("admin_id")->constrained("users");
            $table->foreignId("writer_id")->nullable();
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
        Schema::dropIfExists('orders');
    }
}