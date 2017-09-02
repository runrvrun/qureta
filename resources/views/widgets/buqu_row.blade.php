<div class="row topic-title">
    @foreach ($buqus as $key=>$row)
    <div class="article col-sm-3 grid-group-item">
        <!--Buqu-->
        <br class="break-buqu-mobile">
        <div id="id-title" class="buqu-info">

            <a href="{{ url('/buqu/'.$row->buqu_slug) }}"><img style="width: 100%;height: auto;" src="{{ URL::asset('uploads/buqu/'.$row->buqu_image) }}" alt="{{ $row->buqu_image }}" onerror="buquError(this);" /></a>
             <div class="col-md-12 title" style="position: absolute;width:100%;height: 100%;top:0;margin: 0 auto;">
                                <div class="col-md-12 penulis" style="position: absolute; top:5%;text-align: center;margin: 0 auto;;width: 100%;font-size: 15px;text-shadow: 2px 2px 4px #979aa0;">
                                    {{ HTML::link('/profile/'.$row->buqu_authors->username, $row->buqu_authors->name)}}
                                </div>
                                 <div class="col-md-12 judul" style="position: absolute; bottom:10%;text-align: center;margin: 0 auto;text-shadow: 2px 2px 4px #979aa0;">
                                {{ HTML::link('/buqu/'.$row->buqu_slug, $row->buqu_title)}}
                                </div>
                            </div>
        </div>
        <!--Share Like Buqu-->
        <div class="article-action">
            <span class="action-button"><i class="fa fa-newspaper-o"></i> {{ get_buqu_post_count($row->id) }}</span>
            <span class="action-button"><a class="share_button" data-postid="{{ $row->id }}"><i class="fa fa-share-alt"></i> <span class="share-counter{{ $row->id }}">{{$row->share_count}}</span></a></span>
            @if(Auth::check())
            @if (isLikingBuqu($row->id))
            <span class="action-button"><a class="active btnLike" data-postid="{{ $row->id }}" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
            @else
            <span class="action-button"><a data-postid="{{ $row->id }}" class="btnLike" title="Like"><i class="fa fa-heart"></i> <span class="like-counter{{ $row->id }}">{{ $row->like_count }}</span></a></span>
            @endif
            @else
            <a href="{{ url('/login') }}"><span class="action-button"><i class="fa fa-heart-o"></i> {{$row->like_count}}</span></a>
            @endif
        </div>
        <div class="share{{ $row->id }}" style="display:none"><div class='shareaholic-canvas' data-app='share_buttons' data-app-id='' data-title='Qureta - {{ $row->buqu_title }}' data-link='{{ url('/post/'.$row->post_slug) }}' data-image='{{ url('/post/'.$row->post_slug) }}'></div></div>
    </div>
    @if ($key%4==3)
</div>
<hr class="row-divider">
<div class="row topic-title">
    @endif
    @endforeach
</div>
