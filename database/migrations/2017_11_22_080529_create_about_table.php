<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('about', function (Blueprint $table) {
			$table->increments('id');
			$table->string('category');
			$table->text('value');
			$table->enum('status', ['open', 'close', 'delete']);
			$table->integer('modify_id');
			$table->timestamps();
		});

		DB::statement("ALTER TABLE `about` CHANGE COLUMN `status` ENUM('open', 'close', 'lock', 'delete')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about');
    }
}
