@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Blast Email Reset Password Qureta v3</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Blast email sent.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
