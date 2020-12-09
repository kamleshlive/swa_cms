<div class="form-group {{ $errors->has('left_text') ? 'has-error' : ''}}">
    <label for="left_text" class="control-label">{{ 'Left Text' }}</label>
    <input class="form-control" name="left_text" type="text" id="left_text" value="{!! $update->left_text or ''!!}" >
    {!! $errors->first('left_text', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('right_text') ? 'has-error' : ''}}">
    <label for="right_text" class="control-label">{{ 'Right Text' }}</label>
    <input class="form-control" name="right_text" type="text" id="right_text" value="{!! $update->right_text or ''!!}" >
    {!! $errors->first('right_text', '<p class="help-block">:message</p>') !!}
</div>

@if( isset($update) && !empty($update) &&  !empty($update->image) )
<div class="form-group">
    <label class="control-label">Image Preview</label>

    <img style="width: 300px; height: 200px;" src="{{ $update->image }}">
</div>
@endif

<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image" type="file" id="image" value="{{ $update->image or ''}}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <label for="link" class="control-label">{{ 'Link' }}</label>
    <input class="form-control" name="link" type="text" id="link" value="{!! $update->link or ''!!}" >
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
