
@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Articles</div>
                    <div class="card-body">
                        <a href="{{ url('/author-articles/create') }}" class="btn btn-success btn-sm" title="Add New Article">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/author-articles') }}" accept-charset="UTF-8" class="pull-right form-inline my-2 my-lg-0 float-right" role="search">
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
                                        <th>#</th><th>Art Main Heading</th>
                                        <th>Art Sub Heading</th>
                                        <th>Copy Link</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{!! $item->art_main_heading !!}</td>
                                        <td>{!! $item->art_sub_heading !!}</td>
                                        <td>@php echo '<i data-link="http://swaindia.org/article_dyn.php?q='.base64_encode(base64_encode($item->id)).'" class="copyLink fa fa-link"></i>'; @endphp</td>
                                        {{-- <td>{!! $item->art_author_id !!}</td> --}}
                                        <td>
                                            <a href="{{ url('/author-articles/' . $item->id) }}" title="View Article"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/author-articles/' . $item->id . '/edit') }}" title="Edit Article"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/author-articles' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
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
