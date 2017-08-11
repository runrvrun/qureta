@extends('layouts.admin')

@section('content')
<div class="container">
    <input type="hidden" id="followerid" value="{{ Auth::user()->id }}" />
    @if (Session::has('flash_message'))            
    <div class="alert alert-success alert-dismissible col-md-8" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <p>{!! Session::get('flash_message') !!}</p>
    </div>
    @endif
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Naskah Lomba: {{ $competition_posts[0]->comps->competition_title }}</div>
                <div class="panel-body">

                        <!--<a href="{{ url('/admin/competition_posts/create') }}" class="btn btn-primary btn-xs" title="Add New Competition_post"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>-->
                    <!--                        <br/>
                                            <br/>-->
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th> Judul </th><th> Penulis </th><th>Kata</th><th>View</th><th>Favorit</th><th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($competition_posts as $item)
                            @if(Auth::user()->role === 'admin')
                                @if($item->composts)
                                <tr>
                                    <td>{{ HTML::link('/post/'.$item->composts['post_slug'],$item->composts['post_title']) }}</td>
                                    <td>{{ $item->composts->post_authors['name'] }}</td><td>{{ str_word_count(strip_tags($item->composts->post_content)) }}</td><td>{{ $item->composts->view_count }}</td>
                                    <td>                                        
                                        @if(Auth::check()) 
                                        @if (isLikingCompost($item->id))
                                        <a class="btnLike" data-postid="{{ $item->id }}"><i class="fa fa-star fav active myfav fa-2x"></i></a>
                                        @else
                                        <a data-postid="{{ $item->id }}" class="btnLike"><i class="fa fa-star fav myfav fa-2x"></i></i></a>
                                        @endif
                                        @else                
                                        <a><i class="fa fa-star fav myfav fa-2x"></i></a>
                                        @endif
                                        @if(Auth::user()->role == 'admin')
                                        <?php $otherfav = getOherLikeCompost($item->id); ?>
                                        @if(count($otherfav)>0)
                                        @foreach($otherfav as $of)                                        
                                        <a title="{{ $of->users->name }}"><i class="fa fa-star fav otherfav active fa-2x"></i></a>
                                        @endforeach
                                        @endif
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/post/'.$item->composts['post_slug']) }}" class="btn btn-success btn-xs" title="Buka Tulisan"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/competition_posts', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Dari Lomba" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Competition_post',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @else
                                <tr>
                                <td colspan=5>(post not found)</td>
                                <td>
                                        {!! Form::open([
                                        'method'=>'DELETE',
                                        'url' => ['/admin/competition_posts', $item->id],
                                        'style' => 'display:inline'
                                        ]) !!}
                                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Dari Lomba" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Competition_post',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                        )) !!}
                                        {!! Form::close() !!}
                                    </td>

                                </tr>
                                @endif
                            @else
                                @if($item->composts)
                                <tr>
                                    <td>{{ HTML::link('/post/'.$item->composts['post_slug'],$item->composts['post_title']) }}</td>
                                    <td>{{ $item->composts->post_authors['name'] }}</td><td>{{ str_word_count(strip_tags($item->composts->post_content)) }}</td><td>{{ $item->composts->view_count }}</td>
                                    <td>                                        
                                        @if(Auth::check()) 
                                        @if (isLikingCompost($item->id))
                                        <a class="btnLike" data-postid="{{ $item->id }}"><i class="fa fa-star fav active myfav fa-2x"></i></a>
                                        @else
                                        <a data-postid="{{ $item->id }}" class="btnLike"><i class="fa fa-star fav myfav fa-2x"></i></i></a>
                                        @endif
                                        @else                
                                        <a><i class="fa fa-star fav myfav fa-2x"></i></a>
                                        @endif
                                        @if(Auth::user()->role == 'admin')
                                        <?php $otherfav = getOherLikeCompost($item->id); ?>
                                        @if(count($otherfav)>0)
                                        @foreach($otherfav as $of)                                        
                                        <a title="{{ $of->users->name }}"><i class="fa fa-star fav otherfav active fa-2x"></i></a>
                                        @endforeach
                                        @endif
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/post/'.$item->composts['post_slug']) }}" class="btn btn-success btn-xs" title="Buka Tulisan"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                       
                                    </td>
                                </tr>
                                @else
                                <tr>
                                <td colspan=5>(post not found)</td>
                                <td>
                                        
                                    </td>

                                </tr>
                                @endif
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        @if (method_exists($competition_posts,'render') && $competition_posts->lastPage()>1)
                        <div class="pagination-wrapper"> {!! $competition_posts->render() !!} </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('addjs')
<script>
    $('.btnLike').click(function () {
        var $this = $(this);
        $this.toggleClass('active');
        $this.children("i").toggleClass('active');
        var postid = $this.data('postid');
        var followerid = document.getElementById('followerid').value;
        var token = '{{{ csrf_token() }}}';
        var data = {"_token": token, "postid": postid, "followerid": followerid};
        if ($this.hasClass('active')) {
            $.ajax({
                url: "/admin/competition_posts/unlike",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                }
            });
        } else {
            $.ajax({
                url: "/admin/competition_posts/like",
                type: "POST",
                data: data,
                error: function (exception) {
                    console.log(data)
                },
                success: function () {
                }
            });
        }
    });
</script>
@endsection