
<div class="form-group {{ $errors->has('image_icon') ? 'has-error' : ''}}">
    <label for="image_icon" class="control-label">{{ 'Image Icon' }}</label>
    @if(!empty($sc_dsc->image_icon))
     <img src= "{{$sc_dsc->image_icon}}" class="img-responsive" style="width:20%"><br>
     <input class="form-control" name="image_icon" type="file" id="image_icon" value="{!! $sc_dsc->image_icon or ''!!}" >
    @else
    <input class="form-control" name="image_icon" type="file" id="image_icon" value="{!! $sc_dsc->image_icon or ''!!}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    @endif
</div>

<div class="form-group {{ $errors->has('text') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Text' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ $sc_dsc->name or ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
