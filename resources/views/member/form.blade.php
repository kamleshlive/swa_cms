
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($member->name) ? $member->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('designation') ? 'has-error' : ''}}">
    <label for="designation" class="control-label">{{ 'Designation' }}</label>
    <input class="form-control" name="designation" type="text" id="designation" value="{{ isset($member->designation) ? $member->designation : ''}}" >
    {!! $errors->first('designation', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image" type="file" id="image" value="{{ isset($member->image) ? $member->image : ''}}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('popup_image') ? 'has-error' : ''}}">
    <label for="popup_image" class="control-label">{{ 'Popup Image' }}</label>
    <input class="form-control" name="popup_image" type="file" id="popup_image" value="{{ isset($member->popup_image) ? $member->popup_image : ''}}" >
    {!! $errors->first('popup_image', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('popup_text') ? 'has-error' : ''}}">
    <label for="popup_text" class="control-label">{{ 'Popup Text' }}</label>
    <textarea class="form-control" name="popup_text" type="text" id="popup_text" > {{ isset($member->popup_text) ? $member->popup_text : ''}} </textarea>
    {!! $errors->first('popup_text', '<p class="help-block">:message</p>') !!}
</div>
@if(isset($member))
  <?php

  $pivot =  App\CommiteeMember::where('member_id','=',$member->id)->get()->toArray();
  $pivotcommitee=array();
  if(isset($pivot) && !empty($pivot)){
    foreach ($pivot as $key => $value) {
      $pivotcommitee[]=$value['commitee_id'];
    }
  }
   ?>
@endif
<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}}">
    <label for="parent_id" class="control-label">{{ 'Commitee' }}</label>
    <select name="commitee_id[]" class="form-control" id="status" multiple size="30" style="height: 240px;">

        @if(isset($parent_commitee) && $parent_commitee->isNotEmpty())
            @foreach($parent_commitee as $pc_key => $pc_value)
              <option value="{{$pc_value->id}}"@if(isset($pivotcommitee)) @if( in_array($pc_value->id, $pivotcommitee)) {{'selected'}} @endif @endif>{{++ $pc_key}}. {{ $pc_value->name }}</option>
            @endforeach
        @endif
    </select>
</div>


<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <select name="status" class="form-control" id="status" >
    @foreach (json_decode('{"1": "Active", "0": "Disabled"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($member->status) && $member->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sort_order') ? 'has-error' : ''}}">
    <label for="sort_order" class="control-label">{{ 'Sort Order' }}</label>
    <input class="form-control" name="sort_order" type="number" id="sort_order" value="{{ isset($member->sort_order) ? $member->sort_order : ''}}" >
    {!! $errors->first('sort_order', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>

@section('scripts')
    <script src="//cdn.gaic.com/cdn/ui-bootstrap/0.58.0/js/lib/ckeditor/ckeditor.js"></script>
    <script>
    $(document).ready(function() {
        CKEDITOR.replace('popup_text');
    });
    </script>
@endsection
