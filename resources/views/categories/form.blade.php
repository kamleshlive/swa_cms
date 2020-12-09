<div class="form-group {{ $errors->has('cat_name') ? 'has-error' : ''}}">
    <label for="cat_name" class="control-label">{{ 'Cat Name' }}</label>
    <input class="form-control" name="cat_name" type="text" id="cat_name" value="{!! $category->cat_name or ''!!}" >
    {!! $errors->first('cat_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <input class="form-control" name="status" type="number" id="status" value="{{ $category->status or ''}}" >
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
