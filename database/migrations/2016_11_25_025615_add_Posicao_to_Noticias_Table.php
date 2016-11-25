<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPosicaoToNoticiasTable extends Migration
{
    public function up()
    {
		Schema::table('noticias', function($table) {
			$table->integer('posicao');
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
		public function down()
		{
		Schema::table('noticias', function($table) {
			$table->dropColumn('posicao');
		});
	}
}
