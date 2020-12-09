@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <h1 class="card-header">Commitee</h1>
                    <div class="card-body">
                        <a href="{{ url('/commitee/create') }}" class="btn btn-primary pull-right" title="Add New Commitee">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/commitee') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right pull-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                    <button class="btn btn-secondary" type="submit">
                                      <span class="input-group-append">
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
                                        <th>#</th><th>Name</th><th>About</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($commitee as $item)
                                    <tr>
                                        <td  width="10%">{{ $loop->iteration }}</td>
                                        <td  width="20%">{{ $item->name }}</td>
                                        <td  width="40%">{!! str_limit($item->about,100) !!}</td>
                                        <td width="30%">
                                            <a href="{{ url('/commitee/' . $item->id) }}" title="View Commitee"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/commitee/' . $item->id . '/edit') }}" title="Edit Commitee"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/commitee' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Commitee" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $commitee->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
