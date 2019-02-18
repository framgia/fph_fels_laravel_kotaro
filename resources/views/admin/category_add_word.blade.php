@extends('layouts/admin_word_layout')
@section('pagetitle','Category add word | FELS')
@section('form_header')
<form action="/admin/category/add_word/store/{{$category_id}}" method="POST">
@endsection
