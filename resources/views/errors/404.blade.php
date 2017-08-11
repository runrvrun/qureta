@extends('layouts.app')

@section('title')
- 404 Not Found
@endsection

@section('content')
<style>
    .content {
        text-align: center;
        display: inline-block;
    }

    .title {
        font-size: 156px;
      }

      .quote {
        font-size: 36px;
      }

      .explanation {
        font-size: 24px;
      }
</style>
<div class="content">
        <div class="title">404</div>
        <div class="quote">Halaman Tidak Ditemukan.</div>
        <div class="explanation">
          <br>
          <small>
            <?php
              $default_error_message = "Kembali ke <a href='".url('')."'>halaman depan</a>.";
            ?>
            {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
         </small>
       </div>
      </div>
@endsection
