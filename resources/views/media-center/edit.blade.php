@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <h1 class="card-header">Edit Media Center</h1>
                    <div class="card-body">
                        <a href="{{ url('/media-center') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/media-center/' . $mediacenter->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {!! method_field('PATCH') !!}
                            {!! csrf_field() !!}

                            @include ('media-center.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
