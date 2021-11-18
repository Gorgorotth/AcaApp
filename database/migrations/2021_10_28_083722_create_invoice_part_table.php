<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id');
            $table->string('name');
            $table->string('stock_no')->nullable();
            $table->float('quantity');
            $table->float('price');
            $table->integer('job_type');
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
        Schema::dropIfExists('invoice_parts');
    }
}
