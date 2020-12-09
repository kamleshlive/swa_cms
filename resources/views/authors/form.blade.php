<div class="form-group {{ $errors->has('author_name') ? 'has-error' : ''}}">
    <label for="author_name" class="control-label">{{ 'Author Name' }}</label>
    <input class="form-control" name="author_name" type="text" id="author_name" value="{!! $author->author_name or ''!!}" >
    {!! $errors->first('author_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('author_img_path') ? 'has-error' : ''}}">
    <label for="author_img_path" class="control-label">{{ 'Author Img Path' }}</label>

    @if(!empty($author->author_img_path))
     <img src= "{{$author->author_img_path}}" class="img-responsive" style="width:20%"><br>
     <input class="form-control" name="image" type="text" id="image" value="{!! $author->author_img_path or ''!!}" >
    @else
    <input class="form-control" name="author_img_path" type="file" id="image" value="{!! $author->author_img_path or ''!!}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    @endif
</div>
<div class="form-group {{ $errors->has('author_text') ? 'has-error' : ''}}">
    <label for="author_text" class="control-label">{{ 'Author Text' }}</label>
    <textarea class="form-control" rows="5" name="author_text" type="textarea" id="author_text" >{!! $author->author_text or '' !!}</textarea>
    {!! $errors->first('author_text', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="number" id="status" value="{!! $author->status or '' !!}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
