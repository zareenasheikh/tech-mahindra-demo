<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_quotes', function (Blueprint $table) {
            $table->id();

$table->string('quote_symbol',50);
$table->decimal('quote_open');
$table->decimal('quote_high');
$table->decimal('quote_low');
$table->decimal('quote_price');
$table->integer('quote_volume');
$table->date('quote_latest_trading_day');
$table->decimal('quote_previous_close');
$table->decimal('quote_change');
$table->string('quote_change_percent',30);



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
        Schema::dropIfExists('stock_quotes');
    }
}
