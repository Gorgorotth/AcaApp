<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('garage_id');
            $table->foreignId('mechanic_id');
            $table->foreignId('client_id');
            $table->string('vin');
            $table->string('license_plate');
            $table->string('brand');
            $table->string('model');
            $table->string('invoice_number')->nullable();
            $table->float('total_price')->nullable();
            $table->float('hourly_price');
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
        Schema::dropIfExists('invoices');
    }
}
