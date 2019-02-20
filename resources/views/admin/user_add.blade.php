@extends('layouts/admin_user_form_layout')
@section('pagetitle','Add user | FELS')
@section('form_top')
<form action="/admin/user/store" method="POST">
@endsection
@section('name_value')
{{old('name')}}
@endsection
@section('email_value')
{{old('email')}}
@endsection
