@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">HomeBanner {{ $homebanner->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/home-banners') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/home-banners/' . $homebanner->id . '/edit') }}" title="Edit HomeBanner"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('homebanners' . '/' . $homebanner->id) }}" accept-charset="UTF-8" style="display:inline">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete HomeBanner" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $homebanner->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {!! $homebanner->title !!} </td></tr><tr><th> Image </th><td> {{ $homebanner->image }} </td></tr><tr><th> Status </th><td> {{ $homebanner->status }} </td></tr><tr><th> Sort Order </th><td> {{ $homebanner->sort_order }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
