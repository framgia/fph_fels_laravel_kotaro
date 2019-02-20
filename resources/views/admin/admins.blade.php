@extends('layouts/admin_users_layout')
@section('pagetitle','Admins | FELS')
@section('tbody')
@foreach($ten_admins as $admin)
<tr>
    <td>
        {{$admin->name}}
    </td>
    <td>
        {{$admin->email}}
    </td>
    <td>
        <a href="/admin/user/edit/{{$admin->id}}">Edit</a> | <a href="/admin/user/view_delete/{{$admin->id}}">Delete</a>
    </td>
</tr>
@endforeach
@endsection
@section('button_color','success')
@section('user_or_admin','admin')