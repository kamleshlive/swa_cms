@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Event #{{ $event->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/events') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/events/' . $event->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {!! method_field('PATCH') !!}
                            {!! csrf_field() !!}

                            @include ('events.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection