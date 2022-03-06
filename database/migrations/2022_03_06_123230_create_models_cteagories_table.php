<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsCteagoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cteagories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index()->comment('名称');
            $table->text('description')->nullable()->comment('描述');
            $table->integer('post_coment')->comment('贴子数');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cteagories');
    }
}
