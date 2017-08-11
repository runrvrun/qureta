@extends('layouts.wysiwyg')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">            
                      
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>Baca <a href="http://www.qureta.com/page/tips-menulis">aturan penulisan ini</a> sebelum mengirimkan naskah</p>
            </div>

	    @if ($draftcount > 0)            
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p>Anda memiliki {{ $draftcount }} draft tulisan. {{ HTML::link('/tulisanku/draft','Lihat') }}</p>
            </div>           
	    @endif

            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            {!! Form::open(['url' => '/posts', 'class' => 'form-horizontal', 'id' =>'postform', 'files' => true]) !!}
            {!! Form::hidden('_method', 'POST') !!}
            {!! Form::hidden('view_count', 0) !!}
            {!! Form::hidden('share_count', 0) !!}
            {!! Form::hidden('like_count', 0) !!}
            {!! Form::hidden('comment_status', 'open') !!}
            {!! Form::hidden('post_slug', '') !!}

            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
            <div class="form-group {{ $errors->has('post_author') ? 'has-error' : ''}}">
                <label for="post_author">Penulis</label>		                
                {!! Form::text('post_author_search', Auth::user()->name, array('placeholder' => 'Search User','class' => 'form-control','id'=>'post_author_search')) !!}
                {!! Form::hidden('post_author', Auth::user()->id) !!}
                {!! $errors->first('post_author', '<p class="help-block">:message</p>') !!}                        
            </div>
	    @else
            {!! Form::hidden('post_author', Auth::user()->id) !!}
	    @endif

            @if(isset($lomba))
            <div class="form-group {{ $errors->has('post_title') ? 'has-error' : ''}}">
                {!! Form::hidden('lomba_id', $lomba->id) !!}
                <h4>Kirim tulisan untuk lomba: <strong>{{ $lomba->competition_title }}</strong></h4>
            </div>
            @endif

            <div class="form-group {{ $errors->has('post_title') ? 'has-error' : ''}}">
                {!! Form::text('post_title', null, ['class' => 'form-control', 'placeholder' => 'Judul Tulisan', 'id' => 'post_title', 'required' => 'required']) !!}
                {!! $errors->first('post_title', '<p class="help-block">:message</p>') !!}                        
            </div>
            <div class="form-group {{ $errors->has('post_subtitle') ? 'has-error' : ''}}">
                {!! Form::text('post_subtitle', null, ['class' => 'form-control', 'placeholder' => 'Sub-judul']) !!}
                {!! $errors->first('post_subtitle', '<p class="help-block">:message</p>') !!}
            </div>
            <div id="test" class="form-group {{ $errors->has('post_image') ? 'has-error' : ''}}">     
                {!! $errors->first('post_image', '<p class="help-block">:message</p>') !!}
                <label>Upload Foto/Ilustrasi</label>
                {!! Form::file('post_image', ['id' =>'post_image', 'class' => 'form-control', 'accept' => 'image/*', 'name' =>'post_image']) !!}           
                
                
            </div>
            <div class="form-group {{ $errors->has('post_image_credit') ? 'has-error' : ''}}">
                {!! Form::text('post_image_credit', null, ['class' => 'form-control', 'placeholder' => 'Sumber foto/ilustrasi']) !!}
                {!! $errors->first('post_image_credit', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('post_content') ? 'has-error' : ''}}">
                {!! Form::textarea('post_content', null, ['class' => 'form-control wysiwygeditor']) !!}
                {!! $errors->first('post_content', '<p class="help-block">:message</p>') !!}
            </div>     

            <div class="form-group form-inline {{ $errors->has('post_category') ? 'has-error' : ''}}">
                <div class="col-md-4">Topik {!! Form::select('post_category', get_dd_categories(), null, ['class' => 'form-control']) !!} {!! $errors->first('post_category', '<p class="help-block">:message</p>') !!}</div>                                
                <div class="col-md-4">                    
                    <small id="autosavenotify" class="pull-right"></small>
                </div>
                <div class="col-md-4">
                    {!! Form::hidden('post_status', 'draft') !!}
                    {!! Form::submit('Kirim ke Editor', ['name' => 'savepending', 'class' => 'btn btn-primary pull-right marginleftright']) !!}                    
                    {!! Form::submit('Simpan', ['class' => 'btn btn-success pull-right marginleftright']) !!}                                                            
                </div>
            </div>
            {!! Form::close() !!}              
        </div>
    </div>
</div>
@endsection

@section('addjs')
<script type="text/javascript" src="{{URL::asset('/froala/js/image.min.js')}}"></script> 
<script>
//autosave draft
    var autosaveOn = false;
    var postid = '';
    var method = 'POST';
    $('#post_title').on('input', function (e) {
        if (!autosaveOn) {
            autosaveOn = true;
            setInterval(function () {
                var token = '{{{ csrf_token() }}}';
                var appurl = "{{ url('/posts') }}/";
                var data = {
                    '_method': method,
                    '_token': token,
                    'id': postid,
                    'post_author': $('input[name=post_author]').val(),
                    'post_title': $('input[name=post_title]').val(),
                    'post_subtitle': $('input[name=post_subtitle]').val(),
                    'post_content': $(".wysiwygeditor").froalaEditor('html.get')
                };
                $.ajax({
                    type: "POST",
                    url: "{{ url('post/autosave') }}",
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        //show autosave notification
                        document.getElementById('autosavenotify').innerHTML = 'Disimpan otomatis pada ' + data['lastsaved'];                        
                        postid = data['postid'];
                        //change form to patch
                        $('input[name=_method]').val('PATCH');
                        form = document.getElementById('postform');
                        form.action = appurl + postid;
                    },
                    error: function (exception) {
                        console.log(data);
                    }
                });
            }, 10000);
        }
    })    
</script>
<script>
 $("#post_image").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':
            alert("Gambar Berhasil Diupload");
            break;
        default:
            $(this).val('');
            // error message here
            alert("Silakan Upload Gambar/Ilustrasi");
            break;
    }
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
   $(document).ready(function() {
    src = "{{ route('userautocomplete') }}";
     $("#post_author_search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function(event, ui) {
            $('input[name=post_author]').val(ui.item.id);
        },
        minLength: 3,       
    });
});
</script>
@endsection
