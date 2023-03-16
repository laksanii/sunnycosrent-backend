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
        Schema::create('order_accessories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("order_id")->unsigned();
            $table->bigInteger("accessories_id")->unsigned();
            $table->decimal("price", 10, 0);
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
        Schema::dropIfExists('order_accessories');
    }
};
