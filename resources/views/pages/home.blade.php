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
        <section class="homepage-slider" id="slider">
            <div class="container">
                <div class="main-slider">
									<?php $row = $populer_today[0];?>
                	<div class="flexslider">
                        <ul class="slides">
                            <li>
                                <img src="{{ URL::asset('/uploads/post/'.$row->post_image) }}" alt="{{ $row->post_title }}" />
                                <p class="flex-caption">
																	<a href="{{ url('/post/'.$row->post_slug) }}">{{ $row->post_title }}</a>

																</p>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="slider2">
                    <a href="#"><img src="{{ URL::asset('/uploads/post/'.$populer_today[1]->post_image) }}" alt="{{ $populer_today[1]->post_title }}" /></a>
                    <p class="caption"><a href="{{ url('/post/'.$populer_today[1]->post_slug) }}">{{ $populer_today[1]->post_title }}</a></p>
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
                    	<h5 class="line"><span>{{ HTML::link('/topik-redaksi/aktual','Aktual') }}</span></h5>
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
	                    	<h5 class="line"><span>{{ HTML::link('/topik-redaksi/inspiratif','Inspiratif') }}</span></h5>
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

                    <!-- Kiat -->
										@if(count($kiat))
                    <div class="column-two-third">
                    		<h5 class="line">
                        	<span>{{ HTML::link('/topik-redaksi/kiat','Kiat') }}</span>
                          <div class="navbar hide-on-mobile" style="width:50%;margin-left:50%;">
                              <a id="next1" class="next" href="#"><span></span></a>
                              <a id="prev1" class="prev" href="#"><span></span></a>
                          </div>
                        </h5>

                        <div class="outertight">
													<?php $row = $kiat[0]; ?>
													@component('components.article_box', ['row' => $row])
													@endcomponent
													<?php $row = $kiat[1]; ?>


													<span class="smimg hide-on-mobile">

													<p class="hide-on-mobile" style="margin-top: -10px; font-size: 14px; color: grey;">{{ substr(html_entity_decode(strip_tags($row->post_content)),0,300) }}</p>

													</span>
                        </div>

                        <div class="outertight smimg m-r-no" >
                        	<ul class="block" id="carousel">
																<?php $row = $kiat[1]; ?>
																<li class="hide-on-desktop">
																	@component('components.article_box_small', ['row' => $row])
																	@endcomponent
																</li>
															  <?php $kiat->forget(0);$kiat->forget(1); ?>
																@foreach($kiat as $key=>$row)
                                <li>
																	@component('components.article_box_small', ['row' => $row])
																	@endcomponent
                                </li>
																@endforeach
                            </ul>
                        </div>
                    </div>
										@endif
                    <!-- /Kiat -->

                    <!-- Fiksi -->
										@if(count($fiksi))
                    <div class="column-two-third">
                    	<h5 class="line">
                        	<span>{{ HTML::link('/topik-redaksi/fiski','Fiksi') }}</span>
                            <div class="navbar hide-on-mobile" style="width:50%;margin-left:50%;">
                                <a id="next2" class="next" href="#"><span></span></a>
                                <a id="prev2" class="prev" href="#"><span></span></a>
                            </div>
                        </h5>
                        <div class="outerwide hide-on-mobile" style="height:196px;overflow:hidden;">
                        	<ul class="wnews" id="carousel2">
															@foreach($fiksi as $key=>$row)
															@if($key<4)
                            	<li>
                              	<img src="{{ URL::asset('/uploads/post/thumb/'.$row->post_image) }}" alt="{{ $row->post_title }}" class="alignleft" />
																@component('components.post_author', ['row' => $row])
																@endcomponent
																@if($row->sticky && (Auth::check() && (Auth::user()->role=='admin' || Auth::user()->role=='editor')))
																		 <i class="fa fa-thumb-tack pull-right" style="color:#CCC"></i>
																 @endif
																<?php $topik = get_post_topik($row->id)  ?>

																<h6 class="regular article-title" style="text-align:left;"><span class="meta" style="text-align:left;">{{ $row->published_at->diffForHumans() }} &middot; <i class="fa fa-eye"></i> {{$row->view_count}}  <!-- &middot; <i class="fa fa-tag"></i> <a href="/topik/{{ $topik->category_slug }}">{{ $topik->category_title }}</a> --></span>
                                                                <a href="{{ url('/post/'.$row->post_slug) }}">{{ $row->post_title }}</a></h6>
																<p class="hide-on-mobile" style="margin-top: -10px; font-size: 14px; color: grey;">{{ substr(html_entity_decode(strip_tags($row->post_content)),0,300) }}</p>
															</li>
															@endif
                              @endforeach
                          </ul>
                        </div>

                        <div class="outerwide smimg hide-on-mobile">
                        	<ul class="block2">
                                <li>
																	@component('components.article_box_small', ['row' => $fiksi[4]])
																	@endcomponent
                                </li>
                                <li class="m-r-no">
																	@component('components.article_box_small', ['row' => $fiksi[5]])
																	@endcomponent
                                </li>
                                <li>
																	@component('components.article_box_small', ['row' => $fiksi[6]])
																	@endcomponent
                                </li>
                                <li class="m-r-no">
																	@component('components.article_box_small', ['row' => $fiksi[7]])
																	@endcomponent
                                </li>
                            </ul>
                        </div>
												<div class="outerwide smimg hide-on-desktop">
                        	<ul class="block">
																@foreach($fiksi as $key=>$row)
																@if($key<5)
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
                    <!-- /Fiksi -->

                    <!-- Trending, Populer -->
                	<div class="column-two-third">
											@if(count($fiksi))
											<?php $row = $fiksi[0]; ?>
                    	<div class="outertight">
                        	<h5 class="line"><span>Trending</span></h5>
													<div class="outertight m-r-no">
															<ul class="block smimg">
																@foreach($trending as $key=>$row)
																<li>
																	@component('components.article_box_small', ['row' => $row])
																	@endcomponent
																	@endforeach
																</li>
															</ul>
													</div>
                        </div>
												@endif

												@if(count($populer_today))
                        <div class="outertight m-r-no">
                        	<h5 class="line"><span>Terpopuler</span></h5>
                            <div class="outertight m-r-no">
																<ul  class="block smimg">

																	@foreach($populer_today as $key=>$row)
																	<li>
                                    @component('components.article_box_small', ['row' => $row])
                                    @endcomponent
                                    @endforeach
	                                </li>
																</ul>
                            </div>
                        </div>
												@else
												<!-- <div class="outertight m-r-no">
                        	<h5 class="line"><span>Lomba Esai</span></h5>
                            <div class="outertight m-r-no">
																<h6 class="regular"><small>Tidak ada lomba esai yang sedang berlangsung.</small></h6> -->
                            </div>
                        </div>
												@endif

                    </div>
                    <!-- / Trending, Populer -->

                </div>
                <!-- /Main Content -->

                <!-- Left Sidebar -->
                <div class="column-one-third">
                	<div class="sidebar">
                    	<h5 class="line"><span>Follow Us!</span></h5>
                        <ul class="social">
                        		<li>
                            	<a href="http://facebook.com/qureta" target="_blank">
                            		<img src="https://dev.qureta.com/img/i_fb.png"/>
                            	</a>
                            </li>
                            	<li>
                            	<a href="https://twitter.com/qureta" target="_blank">
                            		<img src="https://dev.qureta.com/img/i_twitt.png"/>
                            	</a>
                            </li>
                            <li>
                            	<a href="http://instagram.com/quretacom" target="_blank">
                            		<img src="https://dev.qureta.com/img/i_ig.png"/>
                            	</a>
                            </li>
                        </ul>
                    </div>

										<div class="sidebar" style="height: 320px;">
												<h5 class="line">
                        	<span>{{ HTML::link('https://kuliah.qureta.com', 'Kuliah Qureta')}}</span>
                            <div class="navbar hide-on-mobile" style="width:50%;margin-left:50%;">
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
										<div class="sidebar article-list">
					          	<h5 class="line"><span></span></h5>
					            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Qresponsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9742758471829304"
     data-ad-slot="4756147752"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
					          </div>
                    <div class="sidebar">
                    	<div id="tabs">
                            <ul>
                                <li><a href="#tabs1">Terbaru</a></li>
                                <li><a href="#tabs2">Terfavorit</a></li>
																<li><a href="#tabs3">Terproduktif</a></li>
                            </ul>
                            <div id="tabs1">
                                <ul>
																		@foreach ($terbaru as $key=>$row)
                                	  <li>
																			@component('components.user_follow', ['row' => $row] )
									                    @endcomponent
                                    </li>
																		@endforeach
																		<li>
																			{{ HTML::link('/penulis-terbaru','Penulis lainnya &raquo;',['style'=>'float:right']) }}
																		</li>
                                </ul>
                            </div>
                            <div id="tabs2">
                                <ul>
																		@foreach ($terfavorit as $key=>$row)
                                	  <li>
																			@component('components.user_follow', ['row' => $row])
									                    @endcomponent
                                    </li>
																		@endforeach
																		<li style="text-alige:right">
																			{{ HTML::link('/penulis-favorit','Penulis lainnya &raquo;',['style'=>'float:right']) }}
																		</li>
                                </ul>
                            </div>
														<div id="tabs3">
                                <ul>
																	@foreach ($terproduktif as $key=>$row)
                                	  <li>
																			@component('components.user_follow', ['row' => $row])
									                    @endcomponent
                                    </li>
																		@endforeach
																		<li style="text-alige:right">
																			{{ HTML::link('/penulis-produktif','Penulis lainnya &raquo;',['style'=>'float:right']) }}
																		</li>
                                </ul>
                            </div>
                        </div>
                    </div>




                    <div class="sidebar">
												<h5 class="line">
                        	<span>{{ HTML::link('/buqu','Buqu') }}</span>
                            <div class="navbar hide-on-mobile" style="width:50%;margin-left:50%;">
                                <a id="next4" class="next" href="#"><span></span></a>
                                <a id="prev4" class="prev" href="#"><span></span></a>
                            </div>
                        </h5>
												<ul class="buqu" id="carouselbuqu">
												@foreach($buqus as $key=>$row)
													<li>
														@component('components.buqu',['row'=>$row])
														@endcomponent
													</li>
													@endforeach
												</ul>
												<div style="padding-top:10px;float:right">
													<a href="{{ url('/buqus/create') }}"><i class="far fa-plus-square"></i> Buat Buqu</a>
												</div>
                    </div>

                    <div class="sidebar">
                        <h5 class="line">
                            <span>{{ HTML::link('/ceritakertas','Cerita Kertas') }}</span>
                            <div class="navbar" style="width:50%;margin-left:50%;">
                            </div>
                        </h5>
												<div class="outertight smimg">
                        	<ul class="block">
																@foreach ($ceritakertas as $key=>$row)
																@if($key<4)
                                <li>
																	@component('components.article_box_small', ['row' => $row])
                                  @endcomponent
                                </li>
																@endif
                                @endforeach
																<li>
																	{{ HTML::link('/ceritakertas','Tulisan lainnya &raquo;',['style'=>'float:right']) }}
																</li>
                            </ul>
                        </div>
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
		touch:	true,
		items: {
			visible: '+4'
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
		touch:	true,
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
		touch:	true,
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
		touch:	true,
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
