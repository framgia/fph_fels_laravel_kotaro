@extends('layouts/admin_word_layout')
@section('pagetitle','Edit word | FELS')
@section('subtitle','Edit')
@section('form_header')
<form action="/admin/category/edit_word/store/{{$word->id}}" method="POST">
@method('PATCH')
@endsection
@section('word',$word->word)
@section('answer',$word->answer)
@section('wrong_answer_1',$word->wrong_answer_1)
@section('wrong_answer_2',$word->wrong_answer_2)
@section('wrong_answer_3',$word->wrong_answer_3)
@section('checked','checked')