
@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <h1 class="card-header">Executive Committee Member</h1>
                    <div class="card-body">
                        <a href="{{ url('/ecommittee/create') }}" class="btn btn-success btn-sm" title="Add New ecommittee">
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
                                @foreach($ecommittee as $item)
                                    <tr>
                                        <td width="5%">{{ $loop->iteration or $item->id }}</td>
                                        <td  width="35%"><img style="height: 100px; width: 100px;" class="img-responsive" src="{{ $item->image_icon }}"></td>
                                        <td width="15%">{{ $item->name }}</td>
                                        <td width="15%">{{ $item->designation }}</td>
                                        <td width="5%">{{ $item->sort }}</td>
                                        <td width="25%">
                                            <a href="{{ url('/ecommittee/' . $item->id) }}" title="View ecommittee"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/ecommittee/' . $item->id . '/edit') }}" title="Edit ecommittee"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/ecommittee' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete ecommittee" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $ecommittee->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
