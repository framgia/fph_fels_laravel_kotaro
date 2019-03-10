@extends('layouts/adminForm')
@section('pageTitle','Category Edit | Admin')
@section('formHeader')
<form action="/admin/category/{{$category->id}}/restore" method="POST">
    @csrf
    @method('PATCH')
    @endsection 