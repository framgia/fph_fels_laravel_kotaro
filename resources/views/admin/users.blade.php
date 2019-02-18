@extends('layouts/admin_users_layout')
@section('pagetitle','Users | FELS')
@section('tbody')
@foreach($ten_users as $user)
<tr>
    <td>
        {{$user->name}}
    </td>
    <td>
        {{$user->email}}
    </td>
    <td>
        <a href="/admin/user/edit/{{$user->id}}">Edit</a> | <a href="/admin/user/delete/{{$user->id}}">Delete</a>
    </td>
</tr>
@endforeach
@endsection