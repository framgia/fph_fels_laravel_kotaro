@extends('layouts/layout')
@section('pagetitle','Learned words list | FELS')
@section('content')
<div class="container">
    <div class="row">
        <div class="border col-lg-2">
            <div>
                <div class="border">
                    <img src="{{asset('storage/' . $user_avatar)}}" alt="" class="img-thumbnail">

                </div>
                <div class="border">
                    <table>
                        <tr>
                            <td>{{$user_name}}</td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">Learned {{ $learned_words_number }} words</a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="#">Learned {{ $learned_lesson_number }} lessons</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
        </div>
        <div class="border col-lg-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        Word
                    </div>
                    <div class="col-lg-3">
                        Answer
                    </div>
                    <div class="col-lg-3">
                        Word
                    </div>
                    <div class="col-lg-3">
                        Answer
                    </div>
                    @foreach($learned_words as $learned_word)
                    <div class="col-lg-3">
                        {{$learned_word->word}}
                    </div>
                    <div class="col-lg-3">
                        {{$learned_word->answer}}
                    </div>

                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection