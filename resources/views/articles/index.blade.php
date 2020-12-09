@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                        <div class="card-header"><h2 style="margin-bottom: 50px">Articles</h2></div>
                    <div class="card-body">
                        <a href="{{ url('/articles/create') }}" class="btn btn-success" title="Add New Article">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New Articles
                        </a>

                        <form method="GET" action="{{ url('/articles') }}" accept-charset="UTF-8" class="pull-right form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span style="float:right" class="input-group-append">
                                    <button class="btn btn-secondary pull-right" type="submit">
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
                                        <th>#</th>
                                        <th>Banner</th>
                                        <th>Main Heading</th>
                                        <th>Sub Heading</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $item)
                                    <tr>

                                        <td>{!! $loop->iteration or $item->id !!}</td>
                                        <td> <img style="height: 100px; width: 180px;" class="img-responsive" src="{{ $item->banner }}"> </td>
                                        <td>{!! $item->main_heading !!}</td>
                                        <td>{!! $item->sub_heading !!}</td>

                                        <td>
                                            <a href="{{ url('/articles/' . $item->id) }}" title="View Article"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/articles/' . $item->id . '/edit') }}" title="Edit Article"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/articles' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                                {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Article" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $articles->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
