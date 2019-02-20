@extends('layouts/admin_user_form_layout')
@section('pagetitle','Delete user | FELS')
@section('form_top')
<form action="/admin/user/delete/{{$user->id}}" method="POST">
@method('DELETE')
@endsection
@section('name_value')
{{$user->name}}
@endsection
@section('email_value')
{{$user->email}}
@endsection
@section('readonly','readonly')
@section('delete_page_readonly','readonly')
@section('button_color','danger')
@section('button_text','DELETE')