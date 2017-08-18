<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('post_author')->default(0);
            $table->longText('post_content');
            $table->text('post_title');
            $table->text('post_subtitle');
            $table->string('post_status',20)->default('publish');
            $table->string('comment_status',20)->default('open');            
            $table->string('post_slug',200);
            $table->string('post_image');
            $table->tinyInteger('reading_duration');
            $table->bigInteger('view_count');
            $table->bigInteger('share_count');
            $table->bigInteger('like_count');
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
        Schema::drop('posts');
    }
}
