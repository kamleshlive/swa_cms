@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <h1 class="card-header">Edit Legal</h1>
                    <div class="card-body">
                        <a href="{{ url('/sc_membership_legal') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/sc_membership_legal/' . $sc_membership_legal->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {!! method_field('PATCH') !!}
                            {!! csrf_field() !!}
                            @include ('sc_membership_legal.form', ['formMode' => 'edit'])

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
