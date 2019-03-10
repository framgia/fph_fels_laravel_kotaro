@extends('layouts/adminForm')
@section('pageTitle','Category Delete | Admin')
@section('readonly','readonly')
@section('buttonColor','danger')
@section('buttonText','Delete')
@section('formHeader')
<form action="/admin/category/{{$category->id}}/delete" method="POST">
    @csrf
    @method('DELETE')
    @endsection 