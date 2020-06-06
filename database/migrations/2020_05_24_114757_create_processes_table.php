<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->unsigned()->index();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->boolean('print')->default(0);
            $table->boolean('cut_paper')->default(0);
            $table->boolean('heat_press')->default(0);
            $table->boolean('cut_print')->default(0);
            $table->boolean('edging')->default(0);
            $table->boolean('pip_side')->default(0);
            $table->boolean('cut_edge')->default(0);
            $table->boolean('pip_strap')->default(0);
            $table->boolean('lock_strap')->default(0);
            $table->boolean('cut_strap')->default(0);
            $table->boolean('pic_pack')->default(0);
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
        Schema::dropIfExists('processes');
    }
}
