@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-10 col-sm-10">
                <div class="card">
                    <h1 class="card-header">Member</h1>
                    <div class="card-body">
                        <a href="{{ url('/member/create') }}" class="btn btn-success pull-right" title="Add New Member">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/member') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Name</th><th>Designation</th><th>Image</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($member as $item)
                                    <tr>
                                        <td width="10%">{{ $loop->iteration }}</td>
                                        <td width="20%">{{ $item->name }}</td>
                                        <td width="20%">{{ $item->designation }}</td>
                                        <td width="20%"><img width="100" height="100" src="{{$item->image}}"></td>
                                        <td width="30%">
                                            <a href="{{ url('/member/' . $item->id) }}" title="View Member"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/member/' . $item->id . '/edit') }}" title="Edit Member"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/member' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Member" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $member->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
