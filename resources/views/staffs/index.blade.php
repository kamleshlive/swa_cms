@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-129">
                <div class="card">
                    <h1 class="card-header">Staffs</h1>
                    <div class="card-body">
                        <a href="{{ url('/staffs/create') }}" class="btn btn-success" title="Add New Staff">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Staff
                        </a>


                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Post</th><th>Sort</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($staffs as $item)
                                    <tr>
                                        <td width="5%">{{ $loop->iteration or $item->id }}</td>
                                        <td width="35%">{{ $item->name }}</td>
                                        <td width="20%">{{ $item->post }}</td>
                                        <td width="15%">{{ $item->rank }}</td>
                                        <td width="25%">
                                            <a href="{{ url('/staffs/' . $item->id) }}" title="View Staff"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/staffs/' . $item->id . '/edit') }}" title="Edit Staff"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/staffs' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Staff" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $staffs->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
