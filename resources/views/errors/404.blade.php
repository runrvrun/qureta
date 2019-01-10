@extends('layouts.app')

@section('title')
- Halaman Tidak Ditemukan
@endsection

@section('content')
<style>
    body{
      background-color: #fff;
    }
    .content {
        width: 100%;
        text-align: center;
        display: inline-block;
    }

    .title {
        font-size: 66px;
      }

      .quote {
        font-size: 36px;
      }

      .explanation {
        font-size: 24px;
      }
      #footer{
        position: fixed;
      	bottom: 0;
      }
</style>
<div class="content">
        <div class="title">:(</div>
        <div class="quote">Halaman Tidak Ditemukan</div>
        <div class="explanation">
          <p>Halaman yang anda cari belum ditulis...</p>
          <br>
          <small>
            <?php
              $default_error_message = "atau kembali ke <a href='".url('')."'>halaman depan</a>.";
            ?>
            Ayo
            <a href="{{ url('/kirim-tulisan')}}" class="btn btn-kirim-tulisan">
                Kirim Tulisan
                <i class="fa fa-pen-nib hvr-icon"></i>
              </a>
            @if (env('APP_DEBUG')=='true' && Auth::check() && Auth::role() == 'admin')
            {!! $default_error_message !!}
            {!! isset($exception)? '<br/><br/><br/><small>'.$exception.'</small>':'' !!}
            @else
            {!! $default_error_message !!}
            @endif
         </small>
       </div>
      </div>
@endsection
