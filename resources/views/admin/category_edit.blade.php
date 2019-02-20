@extends('layouts/admin_category_layout')
@section('pagetitle','Category edit | FELS')

@section('title')
{{$category_data->title}}
@endsection

@section('description')
{{$category_data->description}}
@endsection

@section('category_id')
{{$category_data->id}}
@endsection

@section('method','restore')

@section('method_add')
@method('PATCH')
@endsection

@section('button_text','Edit')