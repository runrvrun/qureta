@extends('layouts.default')

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
<hr class="rowspace">
<div class="row vertical-divider">
    <div class="article col-sm-3 grid-group-item">                        
        <!--Buqu-->
        <div class="buqu-info">
            <img src="{{ URL::asset('uploads/buqu/alice.jpg') }}" onerror="buquError(this);" />   
            <div class="title">Alice in Wonderland</div> 
        </div>
        <!--Share Like-->
        <div class="buqu-action">
            <span class="name ">Erik Sulistyo</span>
            <span><i class="fa fa-share-alt"></i> 123</span>
            <span><i class="fa fa-heart-o"></i> 1234</span>
        </div>      
    </div>
    <div class="article col-sm-3 grid-group-item">
        <!--Buqu-->
        <div class="buqu-info">
            <img src="{{ URL::asset('uploads/buqu/Live-Love-Famous-Canadians-and-the-pets-they-love-cover-2_edited.jpg') }}" onerror="buquError(this);" />                                                        
            <div class="title">Live Love Famous Canadians and The Pets They Love</div> 
        </div>
        <!--Share Like-->
        <div class="buqu-action">
            <span class="name ">Jinan Shafa Safira</span>
            <span><i class="fa fa-share-alt"></i> 123</span>
            <span><i class="fa fa-heart-o"></i> 1234</span>
        </div>
    </div>
    <div class="article col-sm-3 grid-group-item">
        <!--Buqu-->
        <div class="buqu-info">
            <img src="{{ URL::asset('uploads/buqu/jurassic-park_edited.jpg') }}" onerror="buquError(this);" />                                                        
            <div class="title">Jurrasic Park</div> 
        </div>
        <!--Share Like-->
        <div class="buqu-action">
            <span class="name ">Tan Zi Hui Celine</span>
            <span><i class="fa fa-share-alt"></i> 123</span>
            <span><i class="fa fa-heart-o"></i> 1234</span>
        </div>
    </div>
    <div class="article col-sm-3 grid-group-item">
        <!--Buqu-->
        <div class="buqu-info">
            <img src="{{ URL::asset('uploads/buqu/garden_edited.jpg') }}" onerror="buquError(this);" />   
            <div class="title">Gardening With Love</div> 
        </div>
        <!--Share Like-->
        <div class="buqu-action">
            <span class="name ">Kanaya Sativas</span>
            <span><i class="fa fa-share-alt"></i> 123</span>
            <span><i class="fa fa-heart-o"></i> 1234</span>
        </div>
    </div>
</div>
<hr>
<div class="row vertical-divider">
    <div class="article col-sm-3 grid-group-item">                        
        <!--Buqu-->
        <div class="buqu-info">
            <img src="{{ URL::asset('uploads/buqu/dracula-cover-2_edited.jpg') }}" onerror="buquError(this);" />         
            <div class="title">Dracula</div> 
        </div>
        <!--Share Like-->
        <div class="buqu-action">
            <span class="name ">Shinta Naomi</span>
            <span><i class="fa fa-share-alt"></i> 123</span>
            <span><i class="fa fa-heart-o"></i> 1234</span>
        </div>
    </div>
    <div class="article col-sm-3 grid-group-item">
        <!--Buqu-->
        <div class="buqu-info">
            <img src="{{ URL::asset('uploads/buqu/alice.jpg') }}" onerror="buquError(this);" />                                                        
            <div class="title">Super Famous</div> 
        </div>
        <!--Share Like-->
        <div class="buqu-action">
            <span class="name ">Lidya Maulida Djuhandar</span>
            <span><i class="fa fa-share-alt"></i> 123</span>
            <span><i class="fa fa-heart-o"></i> 1234</span>
        </div>
    </div>
    <div class="article col-sm-3 grid-group-item">
        <!--Buqu-->
        <div class="buqu-info">
            <img src="{{ URL::asset('uploads/buqu/120371_4553830_752698_image.jpg') }}" onerror="buquError(this);" />  
            <div class="title">Anna Karenina</div> 
        </div>
        <!--Share Like-->
        <div class="buqu-action">
            <span class="name ">Haruka Nakagawa</span>
            <span><i class="fa fa-share-alt"></i> 123</span>
            <span><i class="fa fa-heart-o"></i> 1234</span>
        </div>
    </div>
    <div class="article col-sm-3 grid-group-item">
        
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
