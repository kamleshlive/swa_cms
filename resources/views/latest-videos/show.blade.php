@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">LatestVideo {{ $latestvideo->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/latest-videos') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/latest-videos/' . $latestvideo->id . '/edit') }}" title="Edit LatestVideo"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('latestvideos' . '/' . $latestvideo->id) }}" accept-charset="UTF-8" style="display:inline">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete LatestVideo" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $latestvideo->id }}</td>
                                    </tr>
                                    <tr><th> Video Text </th><td>{!! $latestvideo->video_text !!}</td></tr><tr><th> Video Link </th><td> {{ $latestvideo->video_link }} </td></tr><tr><th> Status </th><td> {{ $latestvideo->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection