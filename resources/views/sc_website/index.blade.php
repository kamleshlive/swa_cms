@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <h1 class="card-header">Website</h1>
                    <div class="card-body">
                        <a href="{{ url('/sc_website/create') }}" class="btn btn-success btn-sm" title="Add New sc_website">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>


                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Image Icon</th><th>Name</th><th>Designation</th><th>Sort</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sc_website as $item)
                                    <tr>
                                        <td width="5%">{{ $loop->iteration or $item->id }}</td>
                                        <td  width="35%"><img style="height: 200px; width: 200px;" class="img-responsive" src="{{ $item->image_icon }}"></td>
                                        <td width="15%">{{ $item->name }}</td>
                                        <td width="15%">{{ $item->designation }}</td>
                                        <td width="5%">{{ $item->sort }}</td>
                                        <td width="25%">
                                            <a href="{{ url('/sc_website/' . $item->id) }}" title="View sc_website"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/sc_website/' . $item->id . '/edit') }}" title="Edit sc_website"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/sc_website' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete sc_website" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $sc_website->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
