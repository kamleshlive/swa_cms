
@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <h1 class="card-header">TV MBC</h1>
                    <div class="card-body">

                        <a href="{{ url('/sc_tv_mbc/') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/sc_tv_mbc/' . $sc_tv_mbc->id . '/edit') }}" title="Edit sc_tv_mbc"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('sc_tv_mbc' . '/' . $sc_tv_mbc->id) }}" accept-charset="UTF-8" style="display:inline">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete sc_tv_mbc" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $sc_tv_mbc->id }}</td>
                                    </tr>
                                    <tr><th> Image Icon </th><td><img src=" {{ $sc_tv_mbc->image_icon }}" </td></tr>
                                    <tr><th> Popup Image Icon </th><td><img src=" {{ $sc_tv_mbc->popup_image }}" </td></tr>
                                    <tr><th> Name </th><td> {{ $sc_tv_mbc->name }} </td></tr>
                                    <tr><th> Designation </th><td> {{ $sc_tv_mbc->designation }} </td></tr>
                                    <tr><th> Popup Description </th><td> {!! $sc_tv_mbc->popup_description !!} </td></tr>
                                    <tr><th> Sort </th><td> {{ $sc_tv_mbc->sort }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
