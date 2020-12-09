@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2 style="margin-bottom: 50px">Frequently Asked Questions</h2></div>
                    <div class="card-body">
                        <a href="{{ url('/faq/create') }}" class="btn btn-success" title="Add New Faq">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New FAQs
                        </a>

                        <form method="GET" action="{{ url('/faq') }}" accept-charset="UTF-8" class="pull-right form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="pull-right input-group-append">
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
                                        <th>#</th><th>Title</th><th>Quetions</th><th>Answers</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($faq as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{!! $item->title !!}</td><td>{!! $item->quetions !!}</td><td>{!! $item->answer !!}</td>
                                        <td>
                                            <a href="{{ url('/faq/' . $item->id) }}" title="View Faq"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/faq/' . $item->id . '/edit') }}" title="Edit Faq"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/faq' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                               {!! csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Faq" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $faq->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
