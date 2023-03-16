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
        Schema::create('costumes', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->bigInteger("category_id")->unsigned();
            $table->string("sizes", 15);
            $table->string("ld", 10);
            $table->string("lp", 10);
            $table->decimal("price", 10, 0);
            $table->string("status")->default('ready');
            $table->softDeletes();
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
        Schema::dropIfExists('costumes');
    }
};
