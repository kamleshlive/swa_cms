{!! csrf_field() !!}
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{!! $faq->title or ''!!}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('quetions') ? 'has-error' : ''}}">
    <label for="quetions" class="control-label">{{ 'Quetions' }}</label>
    <input class="form-control" name="quetions" type="text" id="quetions" value="{!! $faq->quetions or ''!!}" >
    {!! $errors->first('quetions', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('answer') ? 'has-error' : ''}}">
    <label for="answer" class="control-label">{{ 'Answer' }}</label>
    <textarea class="form-control" rows="5" name="answer" type="textarea" id="answer" >{!! $faq->answer or ''!!}</textarea>
    {!! $errors->first('answer', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

@section('scripts')
    {{-- <script src="{{ asset ('/bower_components/ckeditor/ckeditor.js') }}"></script> --}}
    <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script>
    <script>
    $(document).ready(function() {
        CKEDITOR.replace('answer')
    });
    </script>
@endsection
