<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{!! $homebanner->title or ''!!}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <label for="link" class="control-label">{{ 'Link' }}</label>
    <input class="form-control" name="link" type="text" id="link" value="{!! $homebanner->link or ''!!}" >
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    @if(!empty($homebanner->image))
     <img src= "{{$homebanner->image}}" class="img-responsive" style="width:20%"><br>
     <input class="form-control" name="image" type="file" id="image" value="{!! $homebanner->image or ''!!}" >
    @else
    <input class="form-control" name="image" type="file" id="image" value="{!! $homebanner->image or ''!!}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    @endif
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="number" id="status" value="{!! $homebanner->status or ''!!}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sort_order') ? 'has-error' : ''}}">
    <label for="sort_order" class="control-label">{{ 'Sort Order' }}</label>
    <input class="form-control" name="sort_order" type="number" id="sort_order" value="{!! $homebanner->sort_order or ''!!}" >
    {!! $errors->first('sort_order', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
