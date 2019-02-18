@extends('layouts/admin_word_layout')
@section('pagetitle','Edit word | FELS')
@section('subtitle','Delete')
@section('form_header')
<form action="/admin/category/delete_word/{{$word->id}}" method="POST">
@method('DELETE')
@endsection
@section('word',$word->word)
@section('answer',$word->answer)
@section('wrong_answer_1',$word->wrong_answer_1)
@section('wrong_answer_2',$word->wrong_answer_2)
@section('wrong_answer_3',$word->wrong_answer_3)
@section('checked','checked')
@section('required','')
@section('button_color','danger')
@section('button_text','DELETE')
@section('disabled','disabled')
@section('readonly','readonly')