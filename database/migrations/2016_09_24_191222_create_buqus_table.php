<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuqusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buqus', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('buqu_author')->default(0);
            $table->text('buqu_title');
            $table->text('buqu_image');
            $table->string('buqu_slug',200);
            $table->dateTime('buqu_modified')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->bigInteger('article_count');
            $table->bigInteger('share_count');
            $table->bigInteger('like_count');
            $table->bigInteger('follow_count');
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
        Schema::drop('buqus');
    }
}
