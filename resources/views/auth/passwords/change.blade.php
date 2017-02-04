@extends('layouts.app')

@section('title', 'Change password')

@section('right-navbar-button')

        <div class="pull-right">
            <button class="btn btn-success action-button" type="submit">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save
            </button>
        </div>

@endsection

@section('content')

    <style>
        .action-button {
            margin-top: 7px;
            margin-right: 15px;
            margin-left: 15px;
        }
    </style>


    {{ csrf_field() }}

<div class="row">
    @include('crud.input-field',
    [
        'field_type' => 'password',
        'field_name' => 'old_password',
        'field_label' => 'Old password',
        'field_ref' => 'old-password',
        'field_value' => '',
        'field_placeholder' => 'Current password',
    ])
</div>

    <div class="row">
    @include('crud.input-field',
    [
        'field_type' => 'password',
        'field_name' => 'password',
        'field_label' => 'New password',
        'field_ref' => 'password',
        'field_value' => '',
        'field_placeholder' => 'New password',
    ])

    @include('crud.input-field',
    [
        'field_type' => 'password',
        'field_name' => 'password_confirmation',
        'field_label' => 'Confirm new password',
        'field_ref' => 'password-confirmation',
        'field_value' => '',
        'field_placeholder' => 'Re-enter new password',
    ])
    </div>

@endsection
