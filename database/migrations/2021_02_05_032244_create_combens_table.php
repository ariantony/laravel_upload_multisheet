<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCombensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trs_comben', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('acc_code');
            $table->string('code',12);
            $table->date('recdate');
            $table->string('tid',4);
            $table->string('fvalue');
            $table->string('opttax',2);
            $table->text('att');
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
        Schema::dropIfExists('trs_comben');
    }
}
