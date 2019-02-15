@extends('layouts/layout')
@section('pagetitle','Dash Board | FELS')
@section('content')

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

@endsection