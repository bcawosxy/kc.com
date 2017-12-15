<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('product', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('cover');
			$table->text('content');
			$table->enum('status', ['open', 'close', 'lock', 'delete']);
			$table->boolean('showcase')->default(1);
			$table->integer('admin_id');
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
        Schema::dropIfExists('product');
    }
}
