@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <h1 class="card-header">Member </h1>
                    <div class="card-body">

                        <a href="{{ url('/member') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/member/' . $member->id . '/edit') }}" title="Edit Member"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('member' . '/' . $member->id) }}" accept-charset="UTF-8" style="display:inline">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Member" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $member->id }}</td>
                                    </tr>
                                    <tr><th> Name </th><td> {{ $member->name }} </td></tr>
                                    <tr><th> Designation </th><td> {{ $member->designation }} </td></tr>
                                    <tr><th> Image </th><td><img width="400" height="300" src="{{ $member->image }}" ></td></tr>
                                    @if(isset($member->popup_image))
                                      <tr><th> Popup Image </th><td><img width="400" height="300" src="{{ $member->popup_image }}" > </td></tr>
                                    @endif

                                    @if(isset($member->popup_text))
                                      <tr><th> Popup Text </th><td> {{ $member->popup_text }} </td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
