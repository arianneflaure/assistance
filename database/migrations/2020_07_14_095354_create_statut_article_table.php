<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatutArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statut_article', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->integer('statut_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
 
            $table->foreign('statut_id')->references('id')->on('statut')
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
    {   Schema::table('statut_article', function(Blueprint $table) {
        $table->dropForeign('statut_article_article_id_foreign');
        $table->dropForeign('statut_article_statut_id_foreign');
    });
        Schema::dropIfExists('statut_article');
    }
}
