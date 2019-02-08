@extends('layouts/layout')
@section('pagetitle','Profile | FELS')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div>
                {{$category_data->title}}
            </div>
        </div>
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4">
            <div>
                Result: {{$learned_words_number}} of {{$max_number_of_lesson_words}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 mt-lg-3 mb-lg-2">

        </div>
        <div class="col-lg-5 mt-lg-3 mb-lg-2">
            Word
        </div>
        <div class="col-lg-4 mt-lg-3 mb-lg-2">
            Answer
        </div>
    </div>
    <div class="row">
        @foreach($category_words as $category_word)
        <div class="col-lg-3">
            @if(!empty($category_word->mark))
            o
            @else
            x
            @endif
        </div>
        <div class="col-lg-5">
            {{$category_word->word}}
        </div>
        <div class="col-lg-4">
            {{$category_word->answer}}
        </div>
        @endforeach
    </div>
</div>
@endsection