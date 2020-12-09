@extends('layouts.master')

@section('content')
    <div class="container=fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <h1 class="card-header">Downloads Files <i class="fa fa-file-o" aria-hidden="true"> </i></h1>
                    <div class="card-body">
                        <a href="{{ url('/downloads/create') }}" class="btn btn-success " title="Add New Download">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Title</th><th>File</th><th>Order</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($downloads as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td><i class="fa fa-file-o" aria-hidden="true"> {{ $item->file }}</i></td>
                                        <td>{{ $item->order }}</td>
                                        <td>
                                            <a href="{{ url('/downloads/' . $item->id) }}" title="View Download"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/downloads/' . $item->id . '/edit') }}" title="Edit Download"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/downloads' . '/' . $item->id) }}" enctype="multipart/form-data"  accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Download" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $downloads->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
