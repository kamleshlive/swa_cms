@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Authors</div>
                    <div class="card-body">
                        <a href="{{ url('/authors/create') }}" class="btn btn-success btn-sm" title="Add New Author">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/authors') }}" accept-charset="UTF-8" class="pull-right form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Author Name</th><th>Author Img Path</th><th>Author Text</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($authors as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{!! $item->author_name !!}</td><td><img src="{!! $item->author_img_path !!}" style="width:20%;"></td><td>{!! $item->author_text !!}</td>
                                        <td>
                                            <a href="{{ url('/authors/' . $item->id) }}" title="View Author"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/authors/' . $item->id . '/edit') }}" title="Edit Author"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/authors' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Author" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $authors->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
