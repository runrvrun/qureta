@extends('layouts.app')


@section('addhead')
<style>
.banner-inside-article{
  margin: 0 auto;
  margin: 10px 0 15px 0;
}
.banner-inside-article>a>img{
  width: 50%;
}
</style>
@endsection

@section('content')
<section id="content">
    <div class="container">
      <div style="margin-bottom:20px;">
          @component('components.adsense')
          @endcomponent
      </div>
      <div class="main-content">
          <!-- Single -->
          <div class="column-two-third single">
            <h5 class="line"><span>Buat Buqu</span></h5>

            @if(Session::has('flash_message'))
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
            @endif

            {!! Form::open(['url' => '/buqus', 'class' => 'form-horizontal', 'files' => true]) !!}
            {!! Form::hidden('buqu_author', Auth::user()->id) !!}
            {!! Form::hidden('share_count', 0) !!}
            {!! Form::hidden('like_count', 0) !!}

            <div class="form-group {{ $errors->has('buqu_title') ? 'has-error' : ''}}">
                {!! Form::label('buqu_title', 'Judul Buqu ', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('buqu_title', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('buqu_title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('buqu_image') ? 'has-error' : ''}}">
                {!! Form::label('buqu_image', 'Cover Buqu ', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::file('buqu_image', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('buqu_image', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-4 col-md-4">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
          </div>
          <!-- /Single -->
      </div>
      <div class="column-one-third">
      	  <div class="sidebar article-list">
          	<h5 class="line"><span>Terpopuler</span></h5>
            <?php $populer = get_popular_post(); ?>
            @component('components.article_list_smimage', ['posts' => $populer])
            @endcomponent
          </div>
            @component('components.footer_menu')
            @endcomponent
      </div>
    </div>
</section>
@endsection



@section('addfooter')
@endsection
