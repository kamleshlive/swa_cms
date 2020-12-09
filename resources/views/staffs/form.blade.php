<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ $staff->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('post') ? 'has-error' : ''}}">
    <label for="post" class="control-label">{{ 'Post' }}</label>
    <input class="form-control" name="post" type="text" id="post" value="{{ $staff->post or ''}}" >
    {!! $errors->first('post', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('rank') ? 'has-error' : ''}}">
    <label for="rank" class="control-label">{{ 'Sort' }}</label>
    <input class="form-control" name="rank" type="number" id="rank" value="{{ $staff->rank or ''}}" >
    {!! $errors->first('rank', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
