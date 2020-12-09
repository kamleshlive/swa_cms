<div class="form-group {{ $errors->has('art_main_heading') ? 'has-error' : ''}}">
    <label for="art_main_heading" class="control-label">{{ 'Art Main Heading' }}</label>
    <input class="form-control" name="art_main_heading" type="text" id="art_main_heading" value="{!! $article->art_main_heading or ''!!}" >
    {!! $errors->first('art_main_heading', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('art_sub_heading') ? 'has-error' : ''}}">
    <label for="art_sub_heading" class="control-label">{{ 'Art Sub Heading' }}</label>
    <input class="form-control" name="art_sub_heading" type="text" id="art_sub_heading" value="{!! $article->art_sub_heading or ''!!}" >
    {!! $errors->first('art_sub_heading', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('art_author_id') ? 'has-error' : ''}}">
    <label for="art_author_id" class="control-label">{{ 'Art Author Id' }}</label>
    <select name="art_author_id" class="form-control" id="art_author_id" >
    @foreach ((App\Author::get()) as $optionKey => $optionValue)
        <option value="{{ json_encode($optionValue->id) }}" {{ (isset($article->art_author_id) && $article->art_author_id == $optionValue->id) ? 'selected' : ''}}>{!! $optionValue->author_name !!}</option>
    @endforeach
</select>

    {!! $errors->first('art_author_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('art_content') ? 'has-error' : ''}}">
    <label for="art_content" class="control-label">{{ 'Art Content' }}</label>
    <textarea class="form-control" rows="10" cols="80" name="art_content" type="textarea" id="art_content" >{!! $article->art_content or ''!!}</textarea>
    {!! $errors->first('art_content', '<p class="help-block">:message</p>') !!}
</div>
{{-- <div class="form-group {{ $errors->has('art_date') ? 'has-error' : ''}}">
    <label for="art_date" class="control-label">{{ 'Art Date' }}</label>
    <input class="form-control" name="art_date" type="text" id="art_date" value="{{ $article->art_date or ''}}" >
    {!! $errors->first('art_date', '<p class="help-block">:message</p>') !!}
</div> --}}
<div class="form-group {{ $errors->has('art_category_id') ? 'has-error' : ''}}">
    <label for="art_category_id" class="control-label">{{ 'Art Category Id' }}</label>
    <select name="art_category_id" class="form-control" id="art_category_id" >
        @foreach ((App\Category::get()) as $optionKey => $optionValue)
            <option value="{{ json_encode($optionValue->id) }}" {{ (isset($article->art_category_id) && $article->art_category_id == $optionValue->id) ? 'selected' : ''}}>{!! $optionValue->cat_name !!}</option>
        @endforeach
    </select>
    {!! $errors->first('art_category_id', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('publish') ? 'has-error' : ''}}">
    <label for="publish" class="control-label">{{ 'Publish' }}</label>
    <input class="form-control" name="publish" type="number" id="publish" value="{{ $article->publish or '1'}}"  >
    {!! $errors->first('publish', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('art_main_banner') ? 'has-error' : ''}}">
   <input class="form-control" name="hdn_article_img" type="text" id="hdn_article_img" value="{!! $article->art_main_banner or ''!!}" >
    <label for="image" class="control-label">{{ 'Main Banner' }}</label>
    @if(!empty($article->art_main_banner))
     <img src="{{$article->art_main_banner}}" class="img-responsive" style="width:20%"><br>
     <input class="form-control" name="art_main_banner" type="file" id="image" value="{!! $article->art_main_banner or ''!!}" >
    @else
    <input class="form-control" name="art_main_banner" type="file" id="image" value="{!! $article->art_main_banner or ''!!}" >
    {!! $errors->first('art_main_banner', '<p class="help-block">:message</p>') !!}
    @endif
</div>



<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
@section('scripts')
    {{-- <script src="{{ asset ('/bower_components/ckeditor/ckeditor.js') }}"></script> --}}
    <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script>
    <script>
    $(document).ready(function() {
        $('#art_date').datepicker({
           autoclose: true
        });

        CKEDITOR.replace('art_content');

    });
    </script>
@endsection
