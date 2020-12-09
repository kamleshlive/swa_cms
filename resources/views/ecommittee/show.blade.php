
@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <h1 class="card-header">Executive Committee Member</h1>
                    <div class="card-body">

                        <a href="{{ url('/ecommittee/') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/ecommittee/' . $ecommittee->id . '/edit') }}" title="Edit ecommittee"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('ecommittee' . '/' . $ecommittee->id) }}" accept-charset="UTF-8" style="display:inline">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete ecommittee" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $ecommittee->id }}</td>
                                    </tr>
                                    <tr><th> Image Icon </th><td> <img src=" {{$ecommittee->image_icon }}"> </td></tr>
                                    <tr><th> Popup Image Icon </th><td><img src="{{ $ecommittee->popup_image }}" </td></tr>
                                    <tr><th> Name </th><td> {{ $ecommittee->name }} </td></tr>
                                    <tr><th> Designation </th><td> {{ $ecommittee->designation }} </td></tr>
                                    <tr><th> Popup Description </th><td> {!! $ecommittee->popup_description !!} </td></tr>
                                    <tr><th> Sort </th><td> {{ $ecommittee->sort }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
