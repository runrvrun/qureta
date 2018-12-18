@extends('layouts.app')

@section('title')
@endsection

@section('addhead')
<link rel="stylesheet" type="text/css" href="/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick-theme.css"/>
@endsection

@section('content')
        <!-- Slider -->
				@if(count($populer_today))
        <section id="slider">
            <div class="container">
                <div class="main-slider">
                	<!-- Disuruh Pak luthfi dihilangkan Tulisan POpuler dan warna hijaunya
                     <div class="badg">
                    	<p><a href="#">Populer</a></p>
                    </div> -->
									<?php $row = $populer_today[0];?>
                	<div class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="{{ URL::asset('/uploads/post/'.$row->post_image) }}" alt="{{ $row->post_title }}" />
                                <p class="flex-caption">
																	<a href="{{ url('/post/'.$row->post_slug) }}">{{ $row->post_title }}</a>
																	{{ HTML::link('profile/'.$row->post_authors->username,$row->post_authors->name) }} <small> &middot; {{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca</small>
																</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="slider2">
                    <a href="#"><img src="{{ URL::asset('/uploads/post/'.$populer_today[1]->post_image) }}" alt="{{ $populer_today[1]->post_title }}" /></a>
                    <p class="caption"><a href="{{ url('/post/'.$populer_today[1]->post_slug) }}">{{ $populer_today[1]->post_title }}</a> {{ $populer_today[1]->post_authors->name }} <small> &middot; {{ $populer_today[1]->published_at->diffForHumans() }} &middot; {{read_time($populer_today[1]->post_content)}} menit baca</small></p>
                </div>

								<div class="slider3">
                    <a href="#"><img src="{{ URL::asset('/uploads/post/'.$populer_today[2]->post_image) }}" alt="{{ $populer_today[2]->post_title }}" /></a>
                    <p class="caption"><a href="{{ url('/post/'.$populer_today[2]->post_slug) }}">{{ $populer_today[2]->post_title }}</a></p>
                </div>

								<div class="slider3">
                    <a href="#"><img src="{{ URL::asset('/uploads/post/'.$populer_today[3]->post_image) }}" alt="{{ $populer_today[3]->post_title }}" /></a>
                    <p class="caption"><a href="{{ url('/post/'.$populer_today[3]->post_slug) }}">{{ $populer_today[3]->post_title }}</a></p>
                </div>

            </div>
        </section>
				@endif
        <!-- / Slider -->

        <!-- Content -->
        <section id="content">
            <div class="container">
            	<!-- Main Content -->
                <div class="main-content">

                	<!-- Aktual -->
									@if(count($aktual))
                	<div class="column-one-third">
                    	<h5 class="line"><span>Aktual</span></h5>
                        <div class="outertight smimg">
                        	<ul class="block">
																@foreach ($aktual as $key=>$row)
																@if($key<4)
                                <li>
																	@component('components.article_box_small', ['row' => $row])
																	@endcomponent
                                </li>
																@endif
																@endforeach
                            </ul>
                        </div>
                    </div>
										@endif
                    <!-- /Aktual -->

										<!-- Inspiratif -->
										@if(count($inspiratif))
	                	<div class="column-one-third">
	                    	<h5 class="line"><span>Inspiratif</span></h5>
	                        <div class="outertight smimg">
	                        	<ul class="block">
																	@foreach ($inspiratif as $key=>$row)
																	@if($key<4)
	                                <li>
																		@component('components.article_box_small', ['row' => $row])
																		@endcomponent
	                                </li>
																	@endif
																	@endforeach
	                            </ul>
	                        </div>
	                    </div>
											@endif
	                    <!-- /Aktual -->

                    <!-- Jenaka -->
										@if(count($jenaka))
                    <div class="column-two-third">
                    	<h5 class="line">
                        	<span>Jenaka</span>
                            <div class="navbar">
                                <a id="next1" class="next" href="#"><span></span></a>
                                <a id="prev1" class="prev" href="#"><span></span></a>
                            </div>
                        </h5>

                        <div class="outertight">
													<?php $row = $jenaka[0]; ?>
													@component('components.article_box', ['row' => $row])
													@endcomponent
                        </div>

                        <div class="outertight smimg m-r-no">

                        	<ul class="block" id="carousel">
															  <?php $jenaka->forget(0); ?>
																@foreach($jenaka as $key=>$row)
                                <li>
																	@component('components.article_box_small', ['row' => $row])
																	@endcomponent
                                </li>
																@endforeach
                            </ul>
                        </div>
                    </div>
										@endif
                    <!-- /Jenaka -->

                    <!-- Kiat -->
										@if(count($kiat))
                    <div class="column-two-third">
                    	<h5 class="line">
                        	<span>Kiat</span>
                            <div class="navbar">
                                <a id="next2" class="next" href="#"><span></span></a>
                                <a id="prev2" class="prev" href="#"><span></span></a>
                            </div>
                        </h5>

                        <div class="outerwide" >
                        	<ul class="wnews" id="carousel2">
															@foreach($kiat as $key=>$row)
															@if($key<4)
                            	<li>
                              	<img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_title }}" class="alignleft" />
																@component('components.post_author', ['row' => $row])
																@endcomponent
																@if($row->sticky && (Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='editor')))
																		 <i class="fa fa-thumb-tack pull-right" style="color:#CCC"></i>
																 @endif
																<?php $topik = get_post_topik($row->id)  ?>
																<h6 class="regular article-title" style="text-align:left;"><a href="{{ url('/post/'.$row->post_slug) }}">{{ $row->post_title }}</a></h6>
																<span class="meta" style="text-align:left;">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca &middot; <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a></span>
      											</li>
															@endif
                              @endforeach
                          </ul>
                        </div>

                        <div class="outerwide smimg">
                        	<ul class="block2">
                                <li>
																	@component('components.article_box_small', ['row' => $kiat[4]])
																	@endcomponent
                                </li>
                                <li class="m-r-no">
																	@component('components.article_box_small', ['row' => $kiat[5]])
																	@endcomponent
                                </li>
                                <li>
																	@component('components.article_box_small', ['row' => $kiat[6]])
																	@endcomponent
                                </li>
                                <li class="m-r-no">
																	@component('components.article_box_small', ['row' => $kiat[7]])
																	@endcomponent
                                </li>
                            </ul>
                        </div>
                    </div>
										@endif
                    <!-- /Kiat -->

                    <!-- Fiksi, Lomba Esai -->
                	<div class="column-two-third">
											@if(count($fiksi))
											<?php $row = $fiksi[0]; ?>
                    	<div class="outertight">
                        	<h5 class="line"><span>Fiksi</span></h5>
													@component('components.article_box', ['row' => $row])
													@endcomponent
                            <ul class="block smimg">
															 <?php $fiksi->forget(0); ?>
															 @foreach($fiksi as $key=>$row)
                                <li>
																	@component('components.article_box_small', ['row' => $row])
																	@endcomponent
                                </li>
																@endforeach
                            </ul>
                        </div>
												@endif

												@if(count($lombaesai))
                        <div class="outertight m-r-no">
                        	<h5 class="line"><span>Lomba Esai</span></h5>

                            <div class="outertight m-r-no">
																<ul class="block2 smimg">
																	@foreach($lombaesai as $key=>$row)
																	<li>
	                                    <a href="#"><img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_title }}" class="alignleft" /></a>
	                                    <p>
	                                        <a href="#">{{ $row->post_title }}</a>
	                                    </p>

	                                </li>
																	@endforeach
																</ul>
                            </div>
                        </div>
												@else
												<div class="outertight m-r-no">
                        	<h5 class="line"><span>Lomba Esai</span></h5>
                            <div class="outertight m-r-no">
																<h6 class="regular"><small>Tidak ada lomba esai yang sedang berlangsung.</small></h6>
                            </div>
                        </div>
												@endif

                    </div>
                    <!-- /Fiksi, Lomba Esai -->

                </div>
                <!-- /Main Content -->

                <!-- Left Sidebar -->
                <div class="column-one-third">
                	<div class="sidebar">
                    	<h5 class="line"><span>Follow Us!</span></h5>
                        <ul class="social">
                        		<li>
                            	<a href="http://facebook.com/qureta" target="_blank" class="facebook"><i class="icon-facebook"></i></a>
                            </li>
														<li>
                            	<a href="https://twitter.com/qureta" target="_blank" class="twitter"><i class="icon-twitter"></i></a>
                            </li>
                            <li>
                            	<a href="http://instagram.com/quretacom" target="_blank" class="instagram"><i class="icon-instagram"></i></a>
                            </li>
                        </ul>
                    </div>

										<div class="sidebar">
												<h5 class="line">
                        	<span>{{ HTML::link('https://kuliah.qureta.com', 'Kuliah Qureta')}}</span>
                            <div class="navbar">
                                <a id="next3" class="next" href="#"><span></span></a>
                                <a id="prev3" class="prev" href="#"><span></span></a>
                            </div>
                        </h5>
												<ul class="kuliah" id="carouselkuliah">
														@foreach($kuliah as $key=>$row)
														<li>
															<img src="https://kuliah.qureta.com/uploads/course/{{ $row->url_foto }}" alt="{{ $row->post_title }}"/>
															<h6 class="regular">{!! HTML::link('https://kuliah.qureta.com/course/'.$row->slug, $row->name)!!}</h6>
														</li>
														@endforeach
												</ul>
										</div>

                    <div class="sidebar">
                    	<div id="tabs">
                            <ul>
                                <li><a href="#tabs1">Populer</a></li>
                                <li><a href="#tabs2">Favorit</a></li>
																<li><a href="#tabs3">Produktif</a></li>
                            </ul>
                            <div id="tabs1">
                                <ul>
																	@foreach ($populer_today as $key=>$row)
                                	  <li>
                                    	<a href="{{ url('/post/'.$row->post_slug) }}" class="title">{{ $row->post_title }}</a>
																			<span class="meta" style="text-align:left">{{ $row->published_at->diffForHumans() }} &middot; {{read_time($row->post_content)}} menit baca &middot; <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a></span>
                                    </li>
																		@endforeach
                                </ul>
                            </div>
                            <div id="tabs2">
                                <ul>
																		@foreach ($terfavorit as $key=>$row)
                                	  <li>
																			@component('components.user', ['row' => $row])
									                    @endcomponent
                                    </li>
																		@endforeach
                                </ul>
                            </div>
														<div id="tabs3">
                                <ul>
																	@foreach ($terproduktif as $key=>$row)
                                	  <li>
																			@component('components.user', ['row' => $row])
									                    @endcomponent
                                    </li>
																		@endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar">
												<h5 class="line">
                        	<span>Buqu</span>
                            <div class="navbar">
                                <a id="next4" class="next" href="#"><span></span></a>
                                <a id="prev4" class="prev" href="#"><span></span></a>
                            </div>
                        </h5>
												<ul class="kuliah" id="carouselbuqu">
												@foreach($buqus as $key=>$row)
													<li>
														<img src="{{ URL::asset('uploads/buqu/'.$row->buqu_image) }}" alt="{{ $row->buqu_title }}"/>
														<h6 class="regular">{!! HTML::link('/buqu/'.$row->buqu_slug, $row->buqu_title)!!}</h6>
													</li>
													@endforeach
												</ul>
                    </div>

				@component('components.footer_menu')
                  @endcomponent
                </div>

                <!-- /Left Sidebar -->

            </div>
        </section>
        <!-- / Content -->
				<!-- Adsense -->
				<section id="adsensebottom">
				  @component('components.adsense')
				  @endcomponent
				</section>
				<!-- / Adsense -->
@endsection
@section('addfooter')
<script type="text/javascript" src="js/carouFredSel.js"></script>
<script type="text/javascript" src="js/flexslider-min.js"></script>

<script type="text/javascript" >
jQuery(function(){
	// -----------------------------------------------------  FLEXSLIDER
	jQuery('.flexslider').flexslider({
		animation: 'fade',
		controlNav: false,
		slideshowSpeed: 4000,
		animationDuration: 300
	});

})

jQuery(function() {

	jQuery('#carousel').carouFredSel({
		width: '100%',
		direction   : "bottom",
		scroll : 400,
		items: {
			visible: '+3'
		},
		auto: {
			items: 1,
			timeoutDuration : 4000
		},
		prev: {
			button: '#prev1',
			items: 1
		},
		next: {
			button: '#next1',
			items: 1
		}
	});

	jQuery('#carousel2').carouFredSel({
		width: '100%',
		direction   : "left",
		scroll : {
	        duration : 800
	    },
		items: {
			visible: 1
		},
		auto: {
			items: 1,
			timeoutDuration : 4000
		},
		prev: {
			button: '#prev2',
			items: 1
		},
		next: {
			button: '#next2',
			items: 1
		}
	});

	jQuery('#carouselkuliah').carouFredSel({
		width: '100%',
		direction   : "left",
		scroll : {
					duration : 800
			},
		items: {
			visible: 1
		},
		auto: {
			items: 1,
			timeoutDuration : 4000
		},
		prev: {
			button: '#prev3',
			items: 1
		},
		next: {
			button: '#next3',
			items: 1
		}
	});

	jQuery('#carouselbuqu').carouFredSel({
		width: '100%',
		direction   : "left",
		scroll : {
					duration : 800
			},
		items: {
			visible: 1
		},
		auto: {
			items: 1,
			timeoutDuration : 4000
		},
		prev: {
			button: '#prev4',
			items: 1
		},
		next: {
			button: '#next4',
			items: 1
		}
	});
});
</script>
@endsection
