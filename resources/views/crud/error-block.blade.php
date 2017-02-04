@if ($errors->has($field_name))
    <span class="help-block">
            <strong>{{ $errors->first($field_name) }}</strong>
    </span>
@endif