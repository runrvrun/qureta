@extends('layouts.app')

@section('content')
<!--select view-->
<div class="row">
    <div class="col-md-12 select-view">       
        <div class="btn-group" role="group">
            <button  type="button" id="grid" class="toggle-grid-view btn btn-default"><i class="glyphicon glyphicon-th"></i> Grid</button>
            <button  type="button" id="list" class="toggle-grid-view btn btn-default"><i class="glyphicon glyphicon-th-list"></i> List</button>                
        </div>
    </div>
</div>
<div class="row topic-title">
    <div class="col-sm-12">
        <h3>{{ HTML::link('/topik/aktual', 'AKTUAL')}}</h3>
    </div>
</div>
<div class="row vertical-divider">
        <div class="article col-sm-3 grid-group-item">            
            <!--Author-->
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('avatar/random-image-2.jpg') }}" onerror="avaError(this);" /></div>    
                <div class="name">Imam Unggul Wicaksono</div>
                <div class="title">Penulis, pecinta sastra</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <img src="{{ URL::asset('uploads/random-image-2.jpg') }}" onerror="imgError(this);" />
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">3 jam lalu &middot; 4 menit baca</div>
                <div class="title">{{ HTML::link('/tidak-mudah-menjadi-kucing-renang', 'Tidak Mudah Menjadi Kucing Renang')}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span><i class="fa fa-share-alt"></i> 123</span>
                <span><i class="fa fa-heart-o"></i> 1234</span>
                <span><i class="fa fa-book"></i> 123</span>
            </div>            
        </div>
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('uploads/avatar/contact_pref.jpg') }}" onerror="avaError(this);" /></div>  
                <div class="name">Satria Guruh Hastian</div>
                <div class="title">Ekonom Senior di Bank Indonesia</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <img src="{{ URL::asset('uploads/euros.jpg') }}" onerror="imgError(this);" />
            </div>
            <!--Article-->
            <div class="article-info">
                <div class="info">3 jam lalu &middot; 4 menit baca</div>                        
                <div class="title">{{ HTML::link('/tentang-dirimu-yang-berlayar-ke-timur-eropa', 'Tentang Dirimu Yang Berlayar Ke Timur Eropa')}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span><i class="fa fa-share-alt"></i> 123</span>
                <span><i class="fa fa-heart-o"></i> 1234</span>
                <span><i class="fa fa-book"></i> 123</span>
            </div>                            
        </div>
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('uploads/avatar/facebook-profile-pictures23-420x504.jpg') }}" onerror="avaError(this);" /></div>  
                <div class="name">Eric Franhauser</div>
                <div class="title">Peneliti Freedoria Institute</div>
            </div>            
            <!--Image-->
            <div class="article-image">
                <img src="{{ URL::asset('uploads/random-picture-13.jpg') }}" onerror="imgError(this);" />
            </div>
            <!--Article-->
            <div class="article-info">
                <div class="info">3 jam lalu &middot; 4 menit baca</div>
                <div class="title">{{ HTML::link('/kewarganegaraan-dan-burung-hantu', 'Kewarganegaraan dan Burung Hantu di Negara Tetangga Yang Terisolir Jaman')}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span><i class="fa fa-share-alt"></i> 123</span>
                <span><i class="fa fa-heart-o"></i> 1234</span>
                <span><i class="fa fa-book"></i> 123</span>
            </div>                            
        </div>
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('uploads/avatar/profile_img_edited.jpg') }}" onerror="avaError(this);" /></div>  
                <div class="name">Raden Bagus Trisno Sukmajaya</div>
                <div class="title">Pengamat musik</div>
            </div>            
            <!--Image-->
            <div class="article-image">
                <img src="{{ URL::asset('uploads/music-daft-punk.jpg') }}" onerror="imgError(this);" />
            </div>
            <!--Article-->
            <div class="article-info">
                <div class="info">3 jam lalu &middot; 4 menit baca</div>
                <div class="title">{{ HTML::link('/musikalitas-dan-politik-kita', 'Musikalitas dan Politik Kita')}}</div>                
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span><i class="fa fa-share-alt"></i> 123</span>
                <span><i class="fa fa-heart-o"></i> 1234</span>
                <span><i class="fa fa-book"></i> 123</span>
            </div>
        </div>
    </div>
<hr>
<div class="row vertical-divider">
        <div class="article col-sm-3 grid-group-item">            
            <!--Author-->
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('avatar/random-image-2.jpg') }}" onerror="avaError(this);" /></div>    
                <div class="name">Imam Unggul Wicaksono</div>
                <div class="title">Penulis, pecinta sastra</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <img src="{{ URL::asset('uploads/random-image-2.jpg') }}" onerror="imgError(this);" />
            </div>
            <!--Article-->
            <div class="article-info">                
                <div class="info">3 jam lalu &middot; 4 menit baca</div>
                <div class="title">{{ HTML::link('/tidak-mudah-menjadi-kucing-renang', 'Tidak Mudah Menjadi Kucing Renang')}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span><i class="fa fa-share-alt"></i> 123</span>
                <span><i class="fa fa-heart-o"></i> 1234</span>
                <span><i class="fa fa-book"></i> 123</span>
            </div>            
        </div>
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('uploads/avatar/contact_pref.jpg') }}" onerror="avaError(this);" /></div>  
                <div class="name">Satria Guruh Hastian</div>
                <div class="title">Ekonom Senior di Bank Indonesia</div>
            </div>
            <!--Image-->
            <div class="article-image">
                <img src="{{ URL::asset('uploads/euros.jpg') }}" onerror="imgError(this);" />
            </div>
            <!--Article-->
            <div class="article-info">
                <div class="info">3 jam lalu &middot; 4 menit baca</div>                        
                <div class="title">{{ HTML::link('/tentang-dirimu-yang-berlayar-ke-timur-eropa', 'Tentang Dirimu Yang Berlayar Ke Timur Eropa')}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span><i class="fa fa-share-alt"></i> 123</span>
                <span><i class="fa fa-heart-o"></i> 1234</span>
                <span><i class="fa fa-book"></i> 123</span>
            </div>                            
        </div>
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('uploads/avatar/facebook-profile-pictures23-420x504.jpg') }}" onerror="avaError(this);" /></div>  
                <div class="name">Eric Franhauser</div>
                <div class="title">Peneliti Freedoria Institute</div>
            </div>            
            <!--Image-->
            <div class="article-image">
                <img src="{{ URL::asset('uploads/random-picture-13.jpg') }}" onerror="imgError(this);" />
            </div>
            <!--Article-->
            <div class="article-info">
                <div class="info">3 jam lalu &middot; 4 menit baca</div>
                <div class="title">{{ HTML::link('/kewarganegaraan-dan-burung-hantu', 'Kewarganegaraan dan Burung Hantu di Negara Tetangga Yang Terisolir Jaman')}}</div>
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span><i class="fa fa-share-alt"></i> 123</span>
                <span><i class="fa fa-heart-o"></i> 1234</span>
                <span><i class="fa fa-book"></i> 123</span>
            </div>                            
        </div>
        <div class="article col-sm-3 grid-group-item">
            <!--Author-->
            <div class="user-info">
                <div class="image"><img src="{{ URL::asset('uploads/avatar/profile_img_edited.jpg') }}" onerror="avaError(this);" /></div>  
                <div class="name">Raden Bagus Trisno Sukmajaya</div>
                <div class="title">Pengamat musik</div>
            </div>            
            <!--Image-->
            <div class="article-image">
                <img src="{{ URL::asset('uploads/music-daft-punk.jpg') }}" onerror="imgError(this);" />
            </div>
            <!--Article-->
            <div class="article-info">
                <div class="info">3 jam lalu &middot; 4 menit baca</div>
                <div class="title">{{ HTML::link('/musikalitas-dan-politik-kita', 'Musikalitas dan Politik Kita')}}</div>                
            </div>
            <!--Share Like Buqu-->
            <div class="article-action">
                <span><i class="fa fa-share-alt"></i> 123</span>
                <span><i class="fa fa-heart-o"></i> 1234</span>
                <span><i class="fa fa-book"></i> 123</span>
            </div>
        </div>
    </div>
<!--replace error image-->
<script>
    function imgError(image) {
        image.onerror = "";
        image.src = "/uploads/noimage.jpg";
        return true;
    }
    function avaError(image) {
        image.onerror = "";
        image.src = "/uploads/avatar/noavatar.jpg";
        return true;
    }
    function buquError(image) {
        image.onerror = "";
        image.src = "/uploads/buqu/nocover.jpg";
        return true;
    }
</script>

@endsection
