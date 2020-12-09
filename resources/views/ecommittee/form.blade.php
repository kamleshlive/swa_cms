
    <div class="form-group {{ $errors->has('image_icon') ? 'has-error' : ''}}">
        <label for="image_icon" class="control-label">{{ 'Image Icon' }}</label>
        @if(!empty($ecommittee->image_icon))
         <img src= "{{$ecommittee->image_icon}}" class="img-responsive" style="width:20%"><br>
         <input class="form-control" name="image_icon" type="file" id="image_icon" value="{!! $ecommittee->image_icon or ''!!}" >
        @else
        <input class="form-control" name="image_icon" type="file" id="image_icon" value="{!! $ecommittee->image_icon or ''!!}" >
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
        @endif
    </div>
    
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        <label for="name" class="control-label">{{ 'Name' }}</label>
        <input class="form-control" name="name" type="text" id="name" value="{{ $ecommittee->name or ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('designation') ? 'has-error' : ''}}">
        <label for="designation" class="control-label">{{ 'Designation' }}</label>
        <input class="form-control" name="designation" type="text" id="designation" value="{{ $ecommittee->designation or ''}}" >
        {!! $errors->first('designation', '<p class="help-block">:message</p>') !!}
    </div>
    
    <div class="form-group {{ $errors->has('popup_image') ? 'has-error' : ''}}">
        <label for="popup_image" class="control-label">{{ 'Popup Icon' }}</label>
        @if(!empty($ecommittee->popup_image))
         <img src= "{{$ecommittee->popup_image}}" class="img-responsive" style="width:20%"><br>
         <input class="form-control" name="popup_image" type="file" id="popup_image" value="{!! $ecommittee->popup_image or ''!!}" >
        @else
        <input class="form-control" name="popup_image" type="file" id="popup_image" value="{!! $ecommittee->popup_image or ''!!}" >
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
        @endif
    </div>
    
    <div class="form-group {{ $errors->has('popup_description') ? 'has-error' : ''}}">
        <label for="popup_description" class="control-label">{{ 'Popup Description' }}</label>
        <textarea class="form-control" rows="5" name="popup_description" type="textarea" id="popup_description" >{{ $ecommittee->popup_description or ''}}</textarea>
        {!! $errors->first('popup_description', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group {{ $errors->has('sort') ? 'has-error' : ''}}">
        <label for="sort" class="control-label">{{ 'Sort' }}</label>
        <input class="form-control" name="sort" type="number" id="sort" value="{{ $ecommittee->sort or ''}}" >
        {!! $errors->first('sort', '<p class="help-block">:message</p>') !!}
    </div>
    
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
    </div>
    
    @section('scripts')
        {{-- <script src="{{ asset ('/bower_components/ckeditor/ckeditor.js') }}"></script> --}}
        <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script>
        <script>
        $(document).ready(function() {
            CKEDITOR.replace('about');
            CKEDITOR.replace('popup_description');
        });
        </script>
    @endsection
    