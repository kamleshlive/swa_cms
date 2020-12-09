@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <h1 class="card-header">View updoad file <i class="fa fa-file-o" aria-hidden="true"> </i></h1>
                    <div class="card-body">

                        <a href="{{ url('/downloads') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/downloads/' . $download->id . '/edit') }}" title="Edit Download"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('downloads' . '/' . $download->id) }}" accept-charset="UTF-8" style="display:inline">
                            {!! method_field('DELETE') !!}
                            {!!csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Download" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $download->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $download->title }} </td></tr>
                                    <tr><th> File </th><td><i class="fa fa-file-o" aria-hidden="true"> {{ $download->file }}</i> </td></tr>
                                    <tr><th> Order </th><td> {{ $download->Order }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
