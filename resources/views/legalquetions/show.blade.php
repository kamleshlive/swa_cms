@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            @include('includes.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <h1 class="card-header">Legal Question</h1>
                    <div class="card-body">

                        <a href="{{ url('/legalquetions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/legalquetions/' . $legalquetion->id . '/edit') }}" title="Edit Legalquetion"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('legalquetions' . '/' . $legalquetion->id) }}" accept-charset="UTF-8" style="display:inline">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Legalquetion" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                        
                                    <tr><th> Heading </th><td> {!! $legalquetion->heading !!} </td></tr>
                                    <tr><th> Date </th><td> {!! strtoupper(date('jS F Y', (strtotime($legalquetion->date))))!!} </td></tr>
                                
                                    <tr><th> Category </th><td> {!! $legalquetion->category !!} </td></tr>
                                    <tr><th> Content </th><td> {!! $legalquetion->content !!} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
