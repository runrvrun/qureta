<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Post;
use Image;
use Carbon;
use Session;
use App\Log;
use DB;

class PostsController extends Controller {
  public function getPostId ($id)
  {
    $post = \App\Post::select('id')->where('post_slug', $request->n)->first();
    if($post){
      return $post->id;
    }else{
      return 0;
    }
  }
  public function checkToken ($userLogin,$token)
  {
  	$user = \App\User::where('id', $userLogin)->where(['api_token' => $token])->first();
  	if($user){
  		return true;
  	}
  	else
  	{
  		return false;
  	}
  }
  public function getPostAuthorId ($id)
  {
    $post = \App\Post::select('post_author')->where('id', $id)->first();
    if($post){
      return $post->post_author;
    }else{
      return 0;
    }
  }
  public function getPostAuthor($id)
  {
    $post = \App\Post::select('name')->from('users')->where('id', $id)->first();
    if($post){
      return $post->name;
    }else{
      return 0;
    }
  }
  public function getPostAuthorImage($id)
  {
    $post = \App\Post::select('user_image')->from('users')->where('id', $id)->first();
    if($post){
      $parsed = parse_url($post->user_image);
      if (empty($parsed['scheme'])) {
        return "http://qureta.com/uploads/avatar/".$post->user_image;
      }
      else
      {
        return $post->user_image;
      }
    }else{
      return 0;
    }
  }
  public function getPostAuthorProfesi($id)
  {
    $user = \App\User_metum::select('meta_value as profesi')->where('user_id', $id)->where('meta_name','profesi')->first();
      return $user->profesi;
  }
  public function getPostTitle ($id)
  {
    $post = \App\Post::select('post_title')->where('id', $id)->first();
    if($post){
      return $post->post_title;
    }else{
      return '';
    }
  }
  public function getPostSubtitle ($id)
  {
    $post = \App\Post::select('post_subtitle')->where('id', $id)->first();
    if($post){
      return $post->post_subtitle;
    }else{
      return '';
    }
  }
  public function getPostContent ($id)
  {
    $post = \App\Post::select('post_content')->where('id',$id)->first();
    if($post){
      return $post->post_content;
    }else{
      return 0;
    }
  }
  public function getPostSlug ($id)
  {
    $post = \App\Post::select('post_slug')->where('id',$id)->first();
    if($post){
      return $post->post_slug;
    }else{
      return '';
    }
  }
  public function getPostImage ($id)
  {
    $post = \App\Post::select('post_image')->where('id', $id)->first();
    if($post){
      return 'https://www.qureta.com/uploads/post/'.$post->post_image;
    }else{
      return '';
    }
  }
  public function getPostImageCredit ($id)
  {
    $post = \App\Post::select('post_image_credit')->where('id', $id)->first();
    if($post){
      return $post->post_image_credit;
    }else{
      return '';
    }
  }
  public function getPostViewCount ($id)
  {
    $post = \App\Post::select('view_count')->where('id',$id)->first();
    if($post){
      return $post->view_count;
    }else{
      return 0;
    }
  }
  public function getPostShareCount ($id)
  {
    $post = \App\Post::select('share_count')->where('id',$id)->first();
    if($post){
      return $post->share_count;
    }else{
      return 0;
    }
  }
  public function getPostLikeCount ($id)
  {
    $post = \App\Post::select('like_count')->where('id',$id)->first();
    if($post){
      return $post->like_count;
    }else{
      return 0;
    }
  }
  public function getPostPublish ($id)
  {
    $post = \App\Post::select('published_at')->where('id',$id)->first();
    if($post){
      return $post->published_at;
    }else{
      return 0;
    }
  }
  public function getPostCategory ($id)
  {
    $cat = \App\Post_metum::select('meta_value')->where('meta_name', 'post_category')->where('post_id',$id)->first();
    $post = \App\Category::select('category_title')->where('id', $cat->meta_value)->first();
    if($post){
      return $post;
    }else{
      return 0;
    }
  }
  public function getPostUpdate ($id)
  {
    $post = \App\Post::select('update_at')->where('id',$id)->first();
    if($post){
      return $post->update_at;
    }else{
      return 0;
    }
  }
  public function getPostReadTime ($id)
  {
    $post = \App\Post::select('post_content')->where('id',$id)->first();
    if($post){
      $words = str_word_count(strip_tags($post->post_content));
      $min = floor($words / 200);
      if ($min < 1) {
          $min = 1;
      }
      return $min;
    }else{
      return 0;
    }
  }
  public function getArtikelDraft (Request $request)
  {
  	$userLogin = isset($request->userLogin)? $request->userLogin:0;
	$token = isset($request->token)? $request->token:0;
  	if($this->checkToken($userLogin,$token))
  	{
  		$limit = isset($request->limit)? $request->limit:10;
  		$offset = isset($request->offset)? $request->offset:0;
  		$data = \App\User::select('id')->from('posts')->where('post_author', $userLogin)->where('post_status', 'draft')->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
      if($data->count()>0)
      {
        foreach($data as $key=>$row)
        {
          $post[$key]['id'] = $data[$key]->id;
          $post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->id);
          $post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->id));
          $post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->id));
          $post[$key]['title'] = $this->getPostTitle($data[$key]->id);
          $post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->id);
          $post[$key]['slug'] = $this->getPostSlug($data[$key]->id);
          $post[$key]['post_image'] = $this->getPostImage($data[$key]->id);
          $post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->id);
          $post[$key]['view_count'] = $this->getPostViewCount($data[$key]->id);
          $post[$key]['read_time'] = $this->getPostReadTime($data[$key]->id);
          $post[$key]['share_count'] = $this->getPostShareCount($data[$key]->id);
          $post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->id);
          $post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->id),0,100);
          $post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->id)),0,150)."...";
        }
        return response()->json([
          'status' => 'success',
          'hasil' => $post
        ]);
      }
      else
      {
        return response()->json([
          'status' => 'failed',
          'hasil' => false
        ]);
      }
    }
  }
  public function getArtikelUser (Request $request)
  {
  	$userLogin = isset($request->userLogin)? $request->userLogin:0;
	$token = isset($request->token)? $request->token:0;
  	$limit = isset($request->limit)? $request->limit:10;
      $offset = isset($request->offset)? $request->offset:0;
      $id = isset($request->id)? $request->id:0;
      $data = \App\User::select('id')->from('posts')->where('post_author', $id)->where('post_status', 'publish')->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
      if($data->count()>0)
      {
        foreach($data as $key=>$row)
        {
          $post[$key]['id'] = $data[$key]->id;
          $post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->id);
          $post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->id));
          $post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->id));
          $post[$key]['title'] = $this->getPostTitle($data[$key]->id);
          $post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->id);
          $post[$key]['slug'] = $this->getPostSlug($data[$key]->id);
          $post[$key]['post_image'] = $this->getPostImage($data[$key]->id);
          $post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->id);
          $post[$key]['view_count'] = $this->getPostViewCount($data[$key]->id);
          $post[$key]['read_time'] = $this->getPostReadTime($data[$key]->id);
          $post[$key]['share_count'] = $this->getPostShareCount($data[$key]->id);
          $post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->id);
          $post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->id),0,100);
          $post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->id)),0,150)."...";
        }
        return response()->json([
          'status' => 'success',
          'hasil' => $post
        ]);
      }
    }
  public function getArtikelAktual (Request $request)
  {
	$limit = isset($request->limit)? $request->limit:10;
	$offset = isset($request->offset)? $request->offset:0;
	$data = \App\User::select('post_id')->from('post_meta')->where('meta_name', 'post_featured_category')->where('meta_value',1)->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
	foreach($data as $key=>$row)
	{
		$post[$key]['id'] = $data[$key]->post_id;
		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->post_id);
		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->post_id));
		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->post_id));
		$post[$key]['title'] = $this->getPostTitle($data[$key]->post_id);
		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->post_id);
		$post[$key]['slug'] = $this->getPostSlug($data[$key]->post_id);
		$post[$key]['post_image'] = $this->getPostImage($data[$key]->post_id);
		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->post_id);
		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->post_id);
		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->post_id);
		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->post_id);
		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->post_id);
		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->post_id),0,100);
		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->post_id)),0,100)."...";
	}
	return response()->json([
		'status' => 'success',
		'hasil' => $post
	]);
  }
  public function getArtikelFiksi (Request $request)
  {
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
  	$data = \App\User::select('post_id')->from('post_meta')->where('meta_name', 'post_featured_category')->where('meta_value',2)->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
  	foreach($data as $key=>$row)
  	{
  		$post[$key]['id'] = $data[$key]->post_id;
  		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->post_id);
  		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->post_id));
  		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->post_id));
  		$post[$key]['title'] = $this->getPostTitle($data[$key]->post_id);
  		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->post_id);
  		$post[$key]['slug'] = $this->getPostSlug($data[$key]->post_id);
  		$post[$key]['post_image'] = $this->getPostImage($data[$key]->post_id);
  		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->post_id);
  		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->post_id);
  		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->post_id);
  		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->post_id);
  		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->post_id);
  		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->post_id),0,100);
  		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->post_id)),0,100)."...";
  	}
  	return response()->json([
  		'status' => 'success',
  		'hasil' => $post
  	]);
  }
  public function getArtikelInspiratif (Request $request)
  {
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
  	$data = \App\Post::select('post_id')->from('post_meta')->where('meta_name', 'post_featured_category')->where('meta_value',3)->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
  	foreach($data as $key=>$row)
  	{
  		$post[$key]['id'] = $data[$key]->post_id;
  		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->post_id);
  		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->post_id));
  		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->post_id));
  		$post[$key]['title'] = $this->getPostTitle($data[$key]->post_id);
  		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->post_id);
  		$post[$key]['slug'] = $this->getPostSlug($data[$key]->post_id);
  		$post[$key]['post_image'] = $this->getPostImage($data[$key]->post_id);
  		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->post_id);
  		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->post_id);
  		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->post_id);
  		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->post_id);
  		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->post_id);
  		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->post_id),0,100);
  		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->post_id)),0,100)."...";
  	}
  	return response()->json([
  		'status' => 'success',
  		'hasil' => $post
  	]);
  }
  public function getArtikelJenaka (Request $request)
  {
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
	$data = \App\User::select('post_id')->from('post_meta')->where('meta_name', 'post_featured_category')->where('meta_value',4)->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
	foreach($data as $key=>$row)
	{
		$post[$key]['id'] = $data[$key]->post_id;
		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->post_id);
		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->post_id));
		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->post_id));
		$post[$key]['title'] = $this->getPostTitle($data[$key]->post_id);
		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->post_id);
		$post[$key]['slug'] = $this->getPostSlug($data[$key]->post_id);
		$post[$key]['post_image'] = $this->getPostImage($data[$key]->post_id);
		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->post_id);
		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->post_id);
		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->post_id);
		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->post_id);
		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->post_id);
		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->post_id),0,100);
		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->post_id)),0,100)."...";
	}
	return response()->json([
		'status' => 'success',
		'hasil' => $post
	]);
  }
  public function getArtikelKiat (Request $request)
  {
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
  	$data = \App\User::select('post_id')->from('post_meta')->where('meta_name', 'post_featured_category')->where('meta_value',5)->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
  	foreach($data as $key=>$row)
  	{
  		$post[$key]['id'] = $data[$key]->post_id;
  		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->post_id);
  		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->post_id));
  		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->post_id));
  		$post[$key]['title'] = $this->getPostTitle($data[$key]->post_id);
  		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->post_id);
  		$post[$key]['slug'] = $this->getPostSlug($data[$key]->post_id);
  		$post[$key]['post_image'] = $this->getPostImage($data[$key]->post_id);
  		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->post_id);
  		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->post_id);
  		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->post_id);
  		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->post_id);
  		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->post_id);
  		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->post_id),0,100);
  		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->post_id)),0,100)."...";
  	}
  	return response()->json([
  		'status' => 'success',
  		'hasil' => $post
  	]);
  }
  public function getArtikelLombaEsai (Request $request)
  {
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
  	$data = \App\User::select('post_id')->from('post_meta')->where('meta_name', 'post_featured_category')->where('meta_value',6)->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
  	foreach($data as $key=>$row)
  	{
  		$post[$key]['id'] = $data[$key]->post_id;
  		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->post_id);
  		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->post_id));
  		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->post_id));
  		$post[$key]['title'] = $this->getPostTitle($data[$key]->post_id);
  		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->post_id);
  		$post[$key]['slug'] = $this->getPostSlug($data[$key]->post_id);
  		$post[$key]['post_image'] = $this->getPostImage($data[$key]->post_id);
  		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->post_id);
  		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->post_id);
  		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->post_id);
  		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->post_id);
  		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->post_id);
  		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->post_id),0,100);
  		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->post_id)),0,100)."...";
  	}
  	return response()->json([
  		'status' => 'success',
  		'hasil' => $post
  	]);
  }
  public function getArtikelPremium (Request $request)
  {
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
  	$data = \App\User::select('post_id')->from('post_meta')->where('meta_name', 'post_featured_category')->where('meta_value',7)->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
  	foreach($data as $key=>$row)
  	{
  		$post[$key]['id'] = $data[$key]->post_id;
  		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->post_id);
  		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->post_id));
  		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->post_id));
  		$post[$key]['title'] = $this->getPostTitle($data[$key]->post_id);
  		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->post_id);
  		$post[$key]['slug'] = $this->getPostSlug($data[$key]->post_id);
  		$post[$key]['post_image'] = $this->getPostImage($data[$key]->post_id);
  		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->post_id);
  		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->post_id);
  		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->post_id);
  		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->post_id);
  		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->post_id);
  		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->post_id),0,100);
  		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->post_id)),0,100)."...";
  	}
  	return response()->json([
  		'status' => 'success',
  		'hasil' => $post
    ]);
  }
  
  public function getArtikelTerpopuler (Request $request)
  {
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
  	$data = \App\User::select('id')->from('posts')->where('post_status', 'publish')->orderBy('view_count','DESC')->limit($limit)->offset($offset*$limit)->get();
  	foreach($data as $key=>$row)
  	{
  		$post[$key]['id'] = $data[$key]->id;
  		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->id);
  		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->id));
  		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->id));
  		$post[$key]['title'] = $this->getPostTitle($data[$key]->id);
  		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->id);
  		$post[$key]['slug'] = $this->getPostSlug($data[$key]->id);
  		$post[$key]['post_image'] = $this->getPostImage($data[$key]->id);
  		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->id);
  		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->id);
  		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->id);
  		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->id);
  		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->id);
  		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->id),0,100);
  		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->id)),0,100)."...";
  	}
  	return response()->json([
  		'status' => 'success',
  		'hasil' => $post
  	]);
  }

  public function getArtikelSlide (Request $request)
  {
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
  	$data = \App\User::select('post_id')->from('post_meta')->where('meta_name', 'post_featured_category')->where('meta_value',8)->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
  	foreach($data as $key=>$row)
  	{
  		$post[$key]['id'] = $data[$key]->id;
  		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->id);
  		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->id));
  		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->id));
  		$post[$key]['title'] = $this->getPostTitle($data[$key]->id);
  		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->id);
  		$post[$key]['slug'] = $this->getPostSlug($data[$key]->id);
  		$post[$key]['post_image'] = $this->getPostImage($data[$key]->id);
  		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->id);
  		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->id);
  		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->id);
  		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->id);
  		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->id);
  		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->id),0,100);
  		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->id)),0,100)."...";
  	}
  	return response()->json([
  		'status' => 'success',
  		'hasil' => $post
  	]);
  }

  public function getArtikelWorkshop (Request $request)
  {
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
  	$data = \App\User::select('post_id')->from('post_meta')->where('meta_name', 'post_featured_category')->where('meta_value',10)->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
  	foreach($data as $key=>$row)
  	{
  		$post[$key]['id'] = $data[$key]->id;
  		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->id);
  		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->id));
  		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->id));
  		$post[$key]['title'] = $this->getPostTitle($data[$key]->id);
  		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->id);
  		$post[$key]['slug'] = $this->getPostSlug($data[$key]->id);
  		$post[$key]['post_image'] = $this->getPostImage($data[$key]->id);
  		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->id);
  		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->id);
  		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->id);
  		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->id);
  		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->id);
  		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->id),0,100);
  		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->id)),0,100)."...";
  	}
  	return response()->json([
  		'status' => 'success',
  		'hasil' => $post
  	]);
  }

  public function getArtikelSticky (Request $request)
  {
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
  	$data = \App\User::select('post_id')->from('post_meta')->where('meta_name', 'post_featured_category')->where('meta_value',11)->orderBy('created_at','DESC')->limit($limit)->offset($offset*$limit)->get();
  	foreach($data as $key=>$row)
  	{
  		$post[$key]['id'] = $data[$key]->id;
  		$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->id);
  		$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->id));
  		$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->id));
  		$post[$key]['title'] = $this->getPostTitle($data[$key]->id);
  		$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->id);
  		$post[$key]['slug'] = $this->getPostSlug($data[$key]->id);
  		$post[$key]['post_image'] = $this->getPostImage($data[$key]->id);
  		$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->id);
  		$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->id);
  		$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->id);
  		$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->id);
  		$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->id);
  		$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->id),0,100);
  		$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->id)),0,100)."...";
  	}
  	return response()->json([
  		'status' => 'success',
  		'hasil' => $post
  	]);
  }

  public function bacaArtikel (Request $request)
  {
  	$id = $request->id;
  	$data = \App\Post::select('id')->where('id', $id)->where('post_status', 'publish')->get();
  	if($data->count()==1)
  	{
  		foreach($data as $key=>$row)
  		{
  			$post['id'] = $data[$key]->id;
        $post['author_id'] = $this->getPostAuthorId($data[$key]->id);
        $post['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->id));
        $post['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->id));
        $post['title'] = $this->getPostTitle($data[$key]->id);
        $post['subtitle'] = $this->getPostSubtitle($data[$key]->id);
        $post['slug'] = $this->getPostSlug($data[$key]->id);
        $post['image'] = $this->getPostImage($data[$key]->id);
        $post['image_credit'] = $this->getPostImageCredit($data[$key]->id);
        $post['view_count'] = $this->getPostViewCount($data[$key]->id);
        $post['read_time'] = $this->getPostReadTime($data[$key]->id);
        $post['share_count'] = $this->getPostShareCount($data[$key]->id);
        $post['category'] = $this->getPostCategory($data[$key]->id)->category_title;
        $post['like'] = $this->getPostLikeCount($data[$key]->id);
        $post['tanggal'] = substr($this->getPostPublish($data[$key]->id),0,100);
        $post['content'] = $this->getPostContent($data[$key]->id);
  		}
  		return response()->json([
  			'status' => 'success',
  			'hasil' => $post
  		]);
  	}
  }
  public function bacaArtikelBySlug (Request $request)
  {
  	$slug = $request->slug;
  	$data = \App\Post::select('id')->where('post_slug', $slug)->where('post_status', 'publish')->get();
  	foreach($data as $key=>$row)
      {
        $post['id'] = $data[$key]->id;
        $post['author_id'] = $this->getPostAuthorId($data[$key]->id);
        $post['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->id));
        $post['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->id));
        $post['title'] = $this->getPostTitle($data[$key]->id);
        $post['subtitle'] = $this->getPostSubtitle($data[$key]->id);
        $post['slug'] = $this->getPostSlug($data[$key]->id);
        $post['image'] = $this->getPostImage($data[$key]->id);
        $post['image_credit'] = $this->getPostImageCredit($data[$key]->id);
        $post['view_count'] = $this->getPostViewCount($data[$key]->id);
        $post['read_time'] = $this->getPostReadTime($data[$key]->id);
        $post['share_count'] = $this->getPostShareCount($data[$key]->id);
        $post['category'] = $this->getPostCategory($data[$key]->id)->category_title;
        $post['like'] = $this->getPostLikeCount($data[$key]->id);
        $post['tanggal'] = substr($this->getPostPublish($data[$key]->id),0,100);
        $post['content'] = $this->getPostContent($data[$key]->id);
      }
      return response()->json([
        'status' => 'success',
        'hasil' => $post
      ]);
  }
  public function getSearchArtikel (Request $request)
  {
  	$search = $request->search;
  	$limit = isset($request->limit)? $request->limit:10;
  	$offset = isset($request->offset)? $request->offset:0;
  	$data = \App\User::select('id')->from('posts')->where('post_title','like','%'. $search.'%')->orWhere('post_content','like','%'. $search.'%')->where('post_status', 'publish')->limit($limit)->offset($offset*$limit)->get();
  	if($data->count()>1)
  	{
  		foreach($data as $key=>$row)
  		{
  			$post[$key]['id'] = $data[$key]->id;
  			$post[$key]['author_id'] = $this->getPostAuthorId($data[$key]->id);
  			$post[$key]['author'] = $this->getPostAuthor($this->getPostAuthorId($data[$key]->id));
  			$post[$key]['author_image'] = $this->getPostAuthorImage($this->getPostAuthorId($data[$key]->id));
  			$post[$key]['title'] = $this->getPostTitle($data[$key]->id);
  			$post[$key]['subtitle'] = $this->getPostSubtitle($data[$key]->id);
  			$post[$key]['slug'] = $this->getPostSlug($data[$key]->id);
  			$post[$key]['post_image'] = $this->getPostImage($data[$key]->id);
  			$post[$key]['post_image_credit'] = $this->getPostImageCredit($data[$key]->id);
  			$post[$key]['view_count'] = $this->getPostViewCount($data[$key]->id);
  			$post[$key]['read_time'] = $this->getPostReadTime($data[$key]->id);
  			$post[$key]['share_count'] = $this->getPostShareCount($data[$key]->id);
  			$post[$key]['like_count'] = $this->getPostLikeCount($data[$key]->id);
  			$post[$key]['published_at'] = substr($this->getPostPublish($data[$key]->id),0,100);
  			$post[$key]['content'] = substr(strip_tags($this->getPostContent($data[$key]->id)),0,100)."...";
  		}
  		return response()->json([
  			'status' => 'success',
  			'hasil' => $post
  		]);
  	}
  }
  public function newArtikel (Request $request)
  {
  	$userLogin = isset($request->userLogin)? $request->userLogin:0;
  	$token = isset($request->token)? $request->token:0;
  	if($this->checkToken($userLogin,$token))
  	{
  		$post = new Post;
  		$post->post_author = $userLogin;
  		$post->post_status = 'draft';
  		$post->save();
  		return response()->json([
  			'status' => 'success',
  			'hasil' => [[
          'id' => $post->id,
          'author' => $this->getPostAuthor($post->id),
          'author_id' => $this->getPostAuthorId($post->id),
          'author_image' => $this->getPostAuthorImage($post->id),
          'author_profesi' => $this->getPostAuthorProfesi($post->id),
          'category' => "",
          'like' => false,
          'view_count' => $this->getPostViewCount($post->id),
          'share_count' => $this->getPostShareCount($post->id),
          'like_count' => $this->getPostLikeCount($post->id),
          'read_time' => $this->getPostReadTime($post->id),
          'tanggal' => $this->getPostPublish($post->id),
          'title' => $this->getPostTitle($post->id),
          'subtitle' => $this->getPostSubtitle($post->id),
          'slug' => $this->getPostSlug($post->id),
          'image' => $this->getPostImage($post->id),
          'image_credit' => $this->getPostImageCredit($post->id),
          'content' => $this->getPostContent($post->id),
        ]]
  		]);
  	}
  }
  public function delArtikel (Request $request)
  {
  	$userLogin = isset($request->userLogin)? $request->userLogin:0;
  	$token = isset($request->token)? $request->token:0;
    if($this->checkToken($userLogin,$token))
    {
      $postId = $request->id;
      $post = \App\Post::where('id', $postId)->first();
      if($post->count()>0)
      {
        if($post->post_status == "draft" || $post->post_status == "pending")
        {
          $post->delete();
        }
        else
        {
          $post->post_status = 'delete';
          $post->save();
        }
        return response()->json([
          'status' => 'success',
          'hasil' => ['sukses'=>true]
        ]);
      }
      else
      {
        return response()->json([
          'status' => 'faile',
          'hasil' => ['sukses'=>false]
        ]);
      }
    }
  }
  public function setArtikelImage (Request $request)
  {
    $userLogin = isset($request->userLogin)? $request->userLogin:0;
    $token = isset($request->token)? $request->token:0;
    $id = $request->id;
    if($this->checkToken($userLogin,$token))
    {
    	if ($request->hasFile('imageArtikel')) {
        $post = \App\Post::where('id', $id)->first();
        $uploadPath = public_path('/uploads/post/');
        $uploadThumbPath = public_path('/uploads/post/thumb/');
        $extension = 'jpg';
        $fileName = rand(11111, 99999) . '_' . rand(11111, 99999) . '.' . $extension;
        $file = $request->file('imageArtikel');
        Image::make($file->getRealPath())->fit(300, 179)->encode('jpg', 75)->save($uploadThumbPath . $fileName);
        Image::make($file->getRealPath())->fit(653, 373)->encode('jpg', 75)->save($uploadPath . $fileName)->destroy();
        $post['post_image'] = $fileName;
        $post->save();
        return response()->json([
        'status' => 'success',
        'hasil' => ['sukses' => true]
      ]);
    	}
      else
      {
        return response()->json([
          'status' => 'success',
          'hasil' => ['sukses' => false,'info' => 'no image']
        ]);
      }
      
    }
  }
  public function getCategoryList()
  {
    $data =  DB::table('categories')->select('id','category_title')->get();
    return response()->json([
        'status' => 'success',
        'hasil' => $data
      ]);
  }
  public function getSuggestSearchArtikel()
  {
    
  }
}
