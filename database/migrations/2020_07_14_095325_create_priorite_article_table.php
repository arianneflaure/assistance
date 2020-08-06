<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrioriteArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('priorite_article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->integer('priorite_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
 
            $table->foreign('priorite_id')->references('id')->on('priorite')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   Schema::table('priorite_article', function(Blueprint $table) {
        $table->dropForeign('priorite_article_article_id_foreign');
        $table->dropForeign('priorite_article_priorite_id_foreign');
    });
        Schema::drop('priorite_article');
    }
}
