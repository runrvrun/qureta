<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('competition_author')->default(0);
            $table->dateTime('competition_startdate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('competition_enddate')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('competition_title');
            $table->text('competition_content');
            $table->string('competition_status',20)->default('open');
            $table->bigInteger('post_count');
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
        Schema::drop('competitions');
    }
}
