@if( isset($article) && !empty($article) &&  !empty($article->banner) )
<div class="form-group">
    <label class="control-label">Image Preview :-</label>
    <img style="width: 300px; height: 200px;" src="{{ $article->banner }}">
</div>
@endif


<div class="form-group {{ $errors->has('banner') ? 'has-error' : ''}}">
    <label for="banner" class="control-label">{{ 'Banner' }}</label>
    <input class="form-control" name="banner" type="file" id="banner" value="{!! $article->banner or '' !!}" >
    {!! $errors->first('banner', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('main_heading') ? 'has-error' : ''}}">
    <label for="main_heading" class="control-label">{{ 'Main Heading' }}</label>
    <input class="form-control" name="main_heading" type="text" id="main_heading" value="{!! $article->main_heading or ''!!}" >
    {!! $errors->first('main_heading', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sub_heading') ? 'has-error' : ''}}">
    <label for="sub_heading" class="control-label">{{ 'Sub Heading' }}</label>
    <input class="form-control" name="sub_heading" type="text" id="sub_heading" value="{!! $article->sub_heading or '' !!}" >
    {!! $errors->first('sub_heading', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('author') ? 'has-error' : ''}}">
    <label for="author" class="control-label">{{ 'Author' }}</label>
    <input class="form-control" name="author" type="text" id="author" value="{!! $article->author or '' !!}" >
    {!! $errors->first('author', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <label for="link" class="control-label">{{ 'link' }}</label>
    <input class="form-control" name="link" type="text" id="link" value="{!! $article->link or '' !!}" >
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>



<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
