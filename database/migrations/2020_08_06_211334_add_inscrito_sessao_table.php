<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInscritoSessaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscrito_sessao', function (Blueprint $table) {
            $table->integer('inscrito_id')->unsigned();
            $table->integer('sessao_id')->unsigned();
            $table->boolean("checkin")->default(0);
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscrito_sessao');
    }
}
