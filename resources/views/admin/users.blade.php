@extends('layouts.adminDashboard')
@section('pagetitle','User list | Admin')
@section('body')
<div class="container">
    <a href="/admin/add/user"><button class="mt-4 btn btn-primary form-control">Create new Account</button></a>
    <div class="mt-4">
        <table class="table table-hover">
            <thead class="table-primary">
                <tr>
                    <td>
                        Name
                    </td>
                    <td>
                        E-mail
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="text-turncate" style="min-width:200px;">
                        <a href="#">{{$user->name}}</a>
                    </td>
                    <td class="text-turncate" style="width:50%; min-width:300px;">
                        {{$user->email}}
                    </td>
                    <td style="min-width:200px;">
                        <a href="/admin/user/{{$user->id}}/edit">Edit</a> | <a href="#">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if($pageNumber == 1)
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="/admin/users/1">TOP</a></li>
            <li class="page-item active"><a class="page-link" href="/admin/users/{{$pageNumber}}">{{$pageNumber}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 1}}">{{$pageNumber + 1}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 2}}">{{$pageNumber + 2}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 3}}">{{$pageNumber + 3}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 4}}">{{$pageNumber + 4}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 1}}">NEXT</a></li>
        </ul>
    </nav>
    @elseif($pageNumber == 2)
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="/admin/users/1">TOP</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber - 1}}">{{$pageNumber - 1}}</a></li>
            <li class="page-item active"><a class="page-link" href="/admin/users/{{$pageNumber}}">{{$pageNumber}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 1}}">{{$pageNumber + 1}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 2}}">{{$pageNumber + 2}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 3}}">{{$pageNumber + 3}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 1}}">NEXT</a></li>
        </ul>
    </nav>
    @else
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="/admin/users/1">TOP</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber - 2}}">{{$pageNumber - 2}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber - 1}}">{{$pageNumber - 1}}</a></li>
            <li class="page-item active"><a class="page-link" href="/admin/users/{{$pageNumber}}">{{$pageNumber}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 1}}">{{$pageNumber + 1}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 2}}">{{$pageNumber + 2}}</a></li>
            <li class="page-item"><a class="page-link" href="/admin/users/{{$pageNumber + 1}}">NEXT</a></li>
        </ul>
    </nav>
    @endif
</div>
@endsection 