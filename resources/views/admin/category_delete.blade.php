@extends('layouts/admin_category_layout')
@section('pagetitle','Category edit | FELS')

@section('title')
{{$category_data->title}}
@endsection

@section('description')
{{$category_data->description}}
@endsection

@section('readonly', 'readonly')

@section('category_id')
{{$category_data->id}}
@endsection

@section('method','delete')

@section('required','')

@section('method_add')
@method('DELETE')
@endsection

@section('button_text','DELETE')

@section('button_color','danger')