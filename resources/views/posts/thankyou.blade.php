@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3>Naskah Terkirim</h3>
            @if(Session::has('flash_message'))
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!! Session::get('flash_message') !!}
            </div>
            @endif
            <p>Terima kasih, naskah anda telah kami terima.</p>
            <p>Editor kami akan menyunting naskah anda sebelum terbit.</p>
            <p>{{ isset($addmsg)? $addmsg:'' }}</p>
            <br>
            <a href="{{ url('/') }}" class="btn btn-info">Kembali ke halaman depan</a>
        </div>
    </div>
</div>
@endsection