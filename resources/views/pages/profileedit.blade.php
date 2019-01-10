@extends('layouts.app')

@section('title')
- Edit Profil
@endsection

@section('content')
<!-- Adsense -->
<section id="adsensetop" style="margin-bottom:20px;">
    @component('components.adsense')
    @endcomponent
</section>
<!-- / Adsense -->
<!-- Content -->
<section id="content">
    <div class="container">
      <!-- Main Content -->
        <div class="main-content full-width">
          <div class="outerwide full-width">
            <h5 class="line"><span>Edit Profil</span></h5>

            @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif

            {!! Form::model($profile, [
            'method' => 'PATCH',
            'url' => ['/profile/update'],
            'class' => 'form-horizontal',
            'files' => true,
            'autocomplete' => 'off'
            ]) !!}
            {{ Form::hidden('user_id',$user->id) }}

            <div class="container" style="margin-top:20px;">
              <div class="main-content full-width">
                <div class="outerwide full-width profile-header" style="background: url('{{ isset($user->cover_image) ? URL::asset('/uploads/cover/'.$user->cover_image) : URL::asset('/images/noprofilecover.jpg') }}'); background-size:cover;">
                  <div class="full-width profile-overlay" style="background-color:rgba(255, 255, 255, 0.3);">
                    <!-- Head Content -->
                    <div class="main-content user-profile">
                      <div class="column-two-third">
                        <div class="author">
                            @if(strpos($user->user_image,'ttps://') || strpos($user->user_image,'ttp://'))
                            <div class="user-avatar" style="background-image: url('{{ $user->user_image }}'), url('{{ URL::asset('/images/noavatar32.jpg') }}'); background-size:cover; ">
                            </div>
                            @else
                            <div class="user-avatar" style="background: url('{{ URL::asset('/uploads/avatar/'.$user->user_image) }}'), url('{{ URL::asset('/images/noavatar32.jpg') }}'); background-size:cover; ">
                            </div>
                            @endif
                          <div style="display:inline-block">
                            <div class="user-name">{{ $user->name }}</div>
                            @if(isset($user->role) && ($user->role == 'premium' || $user->role == 'partner' || $user->role == 'admin' || $user->role == 'editor'))
                            <i class="verified-user"></i>
                            @else
                            <i class="unverified-user"></i>
                            @endif
                          </div>
                            <div class="user-profession">{{ get_user_profesi($user->id) }}</div>
                            <div class="user-info-bio">
                                {{ $profile[0]->short_bio ?? ''}}
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('full_name') ? 'has-error' : ''}}">
                {!! Form::label('user_image', 'Foto', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    @if(!empty($user->user_image))
                    <img src="{{ URL::asset('/uploads/avatar/'.$user->user_image) }}" onerror="avaError(this);"/>
                    @endif
                    {!! Form::file('user_image', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('user_image', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('full_name') ? 'has-error' : ''}}">
                {!! Form::label('user_image_cover', 'Foto Cover', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    @if(!empty($user->user_image_cover))
                    <img src="{{ URL::asset('/uploads/cover/'.$user->user_image_cover) }}" onerror="avaError(this);" style="max-width:100%;width:100%;"/>
                    @endif
                    {!! Form::file('user_image_cover', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('user_image_cover', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Nama', ['class' => 'col-md-4 control-label']) !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!} <i class="fa fa-asterisk form-required"></i>
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('tempatlahir') ? 'has-error' : ''}}">
                {!! Form::label('tempatlahir', 'Tempat Lahir', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {{ Form::hidden('tempatlahir_id',null) }}
                    {!! Form::text('tempatlahir', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('tempatlahir', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('tanggallahir') ? 'has-error' : ''}}">
                {!! Form::label('tanggallahir', 'Tanggal Lahir', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {{ Form::hidden('tanggallahir_id',null) }}
                    {!! Form::date('tanggallahir', Carbon::parse($profile->tanggallahir)->format('Y-m-d'), ['class' => 'form-control']) !!}
                    {!! $errors->first('tanggallahir', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('profesi') ? 'has-error' : ''}}">
                {!! Form::label('profesi', 'Profesi', ['class' => 'col-md-4 control-label']) !!}
                    {{ Form::hidden('profesi_id',null) }}
                    {!! Form::text('profesi', null, ['class' => 'form-control']) !!} <i class="fa fa-asterisk form-required"></i>
                    {!! $errors->first('profesi', '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has('short_bio') ? 'has-error' : ''}}">
                {!! Form::label('short_bio', 'Biodata Singkat', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {{ Form::hidden('short_bio_id',null) }}
                    {!! Form::textarea('short_bio', null, ['class' => 'form-control','style' => 'height: 60px;']) !!}
                    {!! $errors->first('short_bio', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
                {!! Form::label('phone_number', 'Nomor Telfon', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {!! Form::text('phone_number', $user->phone_number, ['class' => 'form-control']) !!} <a href="#" data-toggle="tooltip" title="Hanya bisa dilihat Admin"><i class="fa fa-exclamation-circle"></i></a>
                    {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {{ Form::hidden('email_id',null) }}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('kota') ? 'has-error' : ''}}">
                {!! Form::label('kota', 'Kota/Kabupaten', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {{ Form::hidden('kota_id',null) }}
                    {!! Form::text('kota', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('kota', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('minat') ? 'has-error' : ''}}">
                {!! Form::label('minat', 'Minat', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {{ Form::hidden('minat_id',null) }}
                    {!! Form::text('minat', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('minat', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('pendidikan') ? 'has-error' : ''}}">
                {!! Form::label('pendidikan', 'Pendidikan', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {{ Form::hidden('pendidikan_id',null) }}
                    {!! Form::text('pendidikan', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('pendidikan', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('website') ? 'has-error' : ''}}">
                {!! Form::label('website', 'Website', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {{ Form::hidden('website_id',null) }}
                    {!! Form::text('website', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('website', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('twitter') ? 'has-error' : ''}}">
                {!! Form::label('twitter', 'Twitter', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {{ Form::hidden('twitter_id',null) }}
                    {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('twitter', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('linkedin') ? 'has-error' : ''}}">
                {!! Form::label('linkedin', 'LinkedIn', ['class' => 'col-md-4 control-label']) !!}
                <div >
                    {{ Form::hidden('linkedin_id',null) }}
                    {!! Form::text('linkedin', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('linkedin', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'editor')
              <div class="form-group {{ $errors->has('recommended') ? 'has-error' : ''}}">
                  {!! Form::label('recommended', 'Recommended Writer', ['class' => 'col-md-4 control-label']) !!}
                  <div >
                      {{ Form::hidden('recommended_id',null) }}
                      {!! Form::checkbox('recommended', 1, null) !!}
                      {!! $errors->first('recommended', '<p class="help-block">:message</p>') !!}
                  </div>
              </div>
            @else
              {{ Form::hidden('recommended_id',null) }}
              {{ Form::hidden('recommended',null) }}
            @endif
            <div class="form-group">
                <div class="col-md-offset-4 col-md-4">
                    {!! Form::submit('Update Profil', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
            @if(Auth::user()->role === 'admin')
                <div class="col-md-offset-8 col-md-4">
            {!! Form::open([
            'method'=>'DELETE',
            'url' => ['/admin/users', $user->id],
            'style' => 'display:inline'
            ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete user"></span> Delete User', array(
            'type' => 'submit',
            'class' => 'btn btn-danger',
            'title' => 'Delete user',
            'onclick'=>'return confirm("Confirm delete?")'
            )) !!}
            {!! Form::close() !!}
            </div>
		        @endif
          </div>
      </div>
  </div>
</section>
@endsection
