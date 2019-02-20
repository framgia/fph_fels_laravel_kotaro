@extends('layouts/layout')
@section('pagetitle','Lesson {{$category_id}} - {{$progress_number}} | FELS')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-4">
        {{$category_data->title}}
        </div>
        <div class="col-lg-3"></div>
        <div class="col-lg-5">
        {{$progress_number + 1}} of {{$number_of_lesson_words}}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
        <div>
            {{$lesson_word->word}}
        </div>
        </div>
        <div class="col-lg-2"></div>
        <div class="col-lg-6">
            <div>
                <form action="/user/lesson/{{$category_data->id}}" method="POST">
                    @csrf
                    <input type="hidden" name="word_id" value="{{$lesson_word->id}}">
                    @foreach($choices as $choice)
                        <div class="col-lg-4 mb-lg-3">
                            <button name="choiced" type="submit" class="btn btn-primary btn-lg" value="{{$choice}}">{{$choice}}</button>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</div>

@endsection