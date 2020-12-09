
<div class="form-group {{ $errors->has('video_text') ? 'has-error' : ''}}">
    <label for="video_text" class="control-label">{{ 'Video Text' }}</label>
    <input class="form-control" name="video_text" type="text" id="video_text" value="{!! $latestvideo->video_text or ''!!}" >
    {!! $errors->first('video_text', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <label for="link" class="control-label">{{ 'Video Link' }}</label>
    <input class="form-control" name="video_link" type="text" id="link" value="{!! $latestvideo->video_link or ''!!}" >
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    @if(!empty($latestvideo->image))
     <img src= "{{$latestvideo->image}}" class="img-responsive" style="width:20%"><br>
     <input class="form-control" name="image" type="file" id="image" value="{{ $latestvideo->image or ''}}" >
    @else
    <input class="form-control" name="image" type="file" id="image" value="{{ $latestvideo->image or ''}}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    @endif
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="number" id="status" value="{{ $latestvideo->status or ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sort_order') ? 'has-error' : ''}}">
    <label for="sort_order" class="control-label">{{ 'Sort Order' }}</label>
    <input class="form-control" name="sort_order" type="number" id="sort_order" value="{{ $latestvideo->sort_order or ''}}" >
    {!! $errors->first('sort_order', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
