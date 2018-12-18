@extends('layouts.app')


@section('addhead')
@endsection

@section('content')
<section id="content">
    <div class="container">
      <div class="main-content">
          <!-- Single -->
          <div class="column-two-third single">
              <h1>{!! $page->post_title !!}</h1>
              
              {!! $page->post_content !!}

              </div>
          <!-- /Single -->
      </div>
      <div class="column-one-third">
        	<div class="sidebar">
            	<h5 class="line"><span>Terpopuler</span></h5>
                <ul class="social">
                	<li>

                  </li>
                </ul>
            </div>
            <div class="sidebar">
              	<h5 class="line"><span>Penulis Favorit</span></h5>
                  <ul class="social">
                  	<li>

                    </li>
                  </ul>
              </div>
              @component('components.footer_menu')
              @endcomponent
        </div>
    </div>
</section>
@endsection


@section('addfooter')
@endsection
