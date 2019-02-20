@extends('layouts/admin_user_form_layout')
@section('pagetitle','Edit user | FELS')
@section('form_top')
<form action="/admin/user/restore/{{$user->id}}" method="POST">
@method('PATCH')
@endsection
@section('name_value')
{{$user->name}}
@endsection
@section('required','')
@section('email_value')
{{$user->email}}
@endsection
@section('readonly','readonly')
@section('button_color','success')
@section('button_text','Edit')