@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-10">
                <div class="card">
                    <h1 class="card-header">Media Center</h1>
                    <div class="card-body">
                        <!-- <a href="{{ url('/mediacenter/create') }}" class="btn btn-success btn-sm" title="Add New sc_dsc">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a> -->


                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Image</th><th>Text</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sc_dsc as $item)
                                    <tr>
                                        <td width="5%">{{ $loop->iteration or $item->id }}</td>
                                        <td  width="45%"><img style="height: 100px; width: 200px;" class="img-responsive" src="{{ $item->image_icon }}"></td>
                                        <td width="25%">{{ $item->name }}</td>
                                        <td width="25%">
                                            <!-- <a href="{{ url('/mediacenter/' . $item->id) }}" title="View sc_dsc"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a> -->
                                            <a href="{{ url('/mediacenter/' . $item->id . '/edit') }}" title="Edit sc_dsc"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <!-- <form method="POST" action="{{ url('/mediacenter' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete sc_dsc" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form> -->
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $sc_dsc->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
