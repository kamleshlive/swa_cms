@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <h1 class="card-header">Upload New file <i class="fa fa-file-o" aria-hidden="true"> </i></h1>
                    <div class="card-body">
                        <a href="{!! url('/downloads') !!}" title="Back"><button class="btn btn-warning "><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                    <form method="POST" action="{{ url('/downloads') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {!! csrf_field() !!}

                            @include ('downloads.form', ['formMode' => 'create'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
