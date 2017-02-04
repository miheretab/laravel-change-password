<div class="col-sm-6">
    <div class="form-group @if ($errors->has($field_name)) has-error @endif">
        <label for="user-last-name" class="control-label">{{$field_label}}</label>
        <input type="{{isset($field_type) ? $field_type : 'text'}}" name="{{$field_name}}" id="{{$field_ref}}" class="form-control"
               value="{{old($field_name, $field_value)}}" {{$mode === 'show' ? 'disabled' : ''}}
               placeholder="{{$field_placeholder}}"
               @if (isset($on_focus))  onfocus="{{$on_focus}}" @endif
        >
        @include('crud.error-block')
    </div>
</div>