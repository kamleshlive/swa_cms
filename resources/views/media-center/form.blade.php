<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($mediacenter->title) ? $mediacenter->title : ''}}" required>
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('document') ? 'has-error' : ''}}">
    <label for="document" class="control-label">{{ 'Document' }}</label>
    <input class="form-control" name="document" type="file" id="document" value="{{ isset($mediacenter->document) ? $mediacenter->document : ''}}" >
    {!! $errors->first('document', '<p class="help-block">:message</p>') !!}
</div>
<div class="alert alert-warning">
   Upload only PDF file
</div>
<div class="">
   OR
</div>
<div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <label for="link" class="control-label">{{ 'Link' }}</label>
    <input class="form-control" name="link" type="text" id="link" value="{{ isset($mediacenter->link) ? $mediacenter->link : ''}}" >
    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
