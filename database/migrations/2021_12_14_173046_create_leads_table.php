<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->text('user_id');
            $table->integer('type');
            $table->dateTime('date');
            $table->integer('stage');
            $table->float('price');
            $table->string('department');
            $table->text('fio');
            $table->text('phone');
            $table->text('email');
            $table->integer('pay');
            $table->integer('device');
            $table->text('info');
            $table->integer('order_number');

            $table->text('utm_source');
            $table->text('utm_medium');
            $table->text('utm_campaign');
            $table->text('utm_content');
            $table->text('utm_term');
            $table->text('referer_page');
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
        Schema::dropIfExists('leads');
    }
}
