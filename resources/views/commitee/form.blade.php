<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($commitee->name) ? $commitee->name : ''}}" required>
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('parent_id') ? 'has-error' : ''}}">
    <label for="parent_id" class="control-label">{{ 'Parent Commitee' }}</label>
    <select name="parent_id" class="form-control" id="status" >
      <option value="0">None</option>
        @if(isset($parent_commitee) && $parent_commitee->isNotEmpty())
            @foreach($parent_commitee as $key => $value)
              <option value="{{$value->id}}" @if(isset($commitee->parent_id) && $commitee->parent_id==$value->id){{'selected'}} @endif>{{ $value->name }}</option>
            @endforeach
        @endif
    </select>
</div>

<div class="form-group {{ $errors->has('about') ? 'has-error' : ''}}">
    <label for="about" class="control-label">{{ 'About' }}</label>
    <textarea class="form-control" rows="5" name="about" type="textarea" id="about" >{{ isset($commitee->about) ? $commitee->about : ''}}</textarea>
    {!! $errors->first('about', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <select name="status" class="form-control" id="status" >
    @foreach (json_decode('{"1": "Active", "2": "Hidden","0": "Disabled"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($commitee->status) && $commitee->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('sort_order') ? 'has-error' : ''}}">
    <label for="sort_order" class="control-label">{{ 'Sort Order' }}</label>
    <input class="form-control" name="sort_order" type="number" id="sort_order" value="{{ isset($commitee->sort_order) ? $commitee->sort_order : ''}}" >
    {!! $errors->first('sort_order', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
