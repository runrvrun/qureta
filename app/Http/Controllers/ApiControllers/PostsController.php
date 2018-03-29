<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Carbon;
use Session;
use App\Log;

class PostsController extends Controller {
  public function getPostId (Request $request)
  {
    $post = \App\Post::select('id')->where('post_slug', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostAuthorId (Request $request)
  {
    $post = \App\Post::select('post_author')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostTitle (Request $request)
  {
    $post = \App\Post::select('post_title')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostSubtitle (Request $request)
  {
    $post = \App\Post::select('post_subtitle')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostContent (Request $request)
  {
    $post = \App\Post::select('post_content')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostSlug (Request $request)
  {
    $post = \App\Post::select('post_slug')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostImage (Request $request)
  {
    $post = \App\Post::select('post_image')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostImageCredit (Request $request)
  {
    $post = \App\Post::select('post_image_credit')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostViewCount (Request $request)
  {
    $post = \App\Post::select('view_count')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostShareCount (Request $request)
  {
    $post = \App\Post::select('share_count')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostLikeCount (Request $request)
  {
    $post = \App\Post::select('like_count')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostPublish (Request $request)
  {
    $post = \App\Post::select('published_at')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostCategory (Request $request)
  {
    $cat = \App\Post_metum::select('meta_value')->where('meta_name', 'post_category')->where('post_id',$request->n)->first();
    $post = \App\Category::select('category_title')->where('id', $cat->meta_value)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostUpdate (Request $request)
  {
    $post = \App\Post::select('update_at')->where('id', $request->n)->first();
    if($post){
      return response()->json([
        'status' => 'success',
        'data' => $post
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getPostReadTime (Request $request)
  {
    $post = \App\Post::select('post_content')->where('id', $request->n)->first();
    if($post){
      $words = str_word_count(strip_tags($post->post_content));
      $min = floor($words / 200);
      if ($min < 1) {
          $min = 1;
      }
      return response()->json([
        'status' => 'success',
        'data' => $min
      ]);
    }else{
      return response()->json([
        'status' => 'fail',
        'data' => ['message' => 'Data not found.']
      ]);
    }
  }
  public function getArtikelDraft (Request $request)
  {
  }
  public function getArtikelUser (Request $request)
  {
  }
  public function getArtikelAktual (Request $request)
  {
  }
  public function getArtikelFiksi (Request $request)
  {
  }
  public function getArtikelInspiratif (Request $request)
  {
  }
  public function getArtikelJenaka (Request $request)
  {
  }
  public function getArtikelKiat (Request $request)
  {
  }
  public function getArtikelLombaEsai (Request $request)
  {
  }
  public function getArtikelPremium (Request $request)
  {
  }
  public function getArtikelTerpopuler (Request $request)
  {
  }
  public function getArtikelSlide (Request $request)
  {
  }
  public function getArtikelWorkshop (Request $request)
  {
  }
  public function getArtikelSticky (Request $request)
  {
  }
  public function artikelTerbaca (Request $request)
  {
  }
  public function artikelTerbacaSlug (Request $request)
  {
  }
  public function bacaArtikel (Request $request)
  {
  }
  public function bacaArtikelBySlug (Request $request)
  {
  }
  public function getSearchArtikel (Request $request)
  {
  }
  public function checkLike (Request $request)
  {
  }
  public function newArtikel (Request $request)
  {
  }
  public function setArtikel (Request $request)
  {
  }
  public function delArtikel (Request $request)
  {
  }
  public function setArtikelImage (Request $request)
  {
  }
  public function getCategoryList  (Request $request)
  {
  }
  public function getSuggestSearchArtikel   (Request $request)
  {
  }
  public function getShortContent (Request $request)
  {
  }
}
