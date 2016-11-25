<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasDestaqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticiasdestaque', function (Blueprint $table) {
            $table->increments('id');
			$table->timestamp('visualizar');
			$table->boolean('orientacao');
			$table->boolean('ativo');
			$table->string('titulo', 32)->nullable();
            $table->string('descricao', 128)->nullable();
            $table->string('banner');
            $table->text('texto')->nullable();
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
        Schema::drop('noticiasdestaque');
    }
}
