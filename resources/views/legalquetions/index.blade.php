@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('includes.sidebar')

            <div class="col-md-12">
                <div class="card">
                    <h1 class="card-header">Legal Questions</h1>
                    <div class="card-body">
                        <a href="{{ url('/legalquetions/create') }}" class="btn btn-success" title="Add New Legalquetion">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                       

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Heading</th><th>Date</th><th>Category</th><th>Content</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($legalquetions as $item)
                                    <tr>
                                        <td width="1%">{{ $loop->iteration or $item->id }}</td>
                                        <td width="25%">{!! str_limit($item->heading,70, '...' )!!}</td>
                                        <td width="10%"> {{ strtoupper(date('jS F Y', (strtotime($item->date))))}} </td>
                                        <td width="5%">{{ $item->category }}</td>
                                        <td width="34%">{!! str_limit($item->content,150, '...' )!!}</td>
                                        <td width="25%">
                                            <a href="{{ url('/legalquetions/' . $item->id) }}" title="View Legalquetion"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/legalquetions/' . $item->id . '/edit') }}" title="Edit Legalquetion"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/legalquetions' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {!! method_field('DELETE') !!}
                                                {!!csrf_field() !!}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Legalquetion" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $legalquetions->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
