@extends('layouts/layout')
@section('pagetitle','Dash Board | FELS')
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
                                <a href="/user/learnedwordslist/{{Auth::id()}}">Learned {{ $learned_words_number }} words</a>
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
            <div>
                <div class="border">
                    Activities<br>
                    ___________________________
                </div>
                <div class="border">
                    <div class="container">
                        <div class="row">

                            @foreach($user_activities as $user_activity)
                            <div class="col-lg-2">
                                <img src="{{asset('storage/' . $user_activity['avatar_url'])}}" alt="" class="img-thumbnail">
                            </div>
                            <div class="col-lg-7">
                                <?php echo $user_activity['message']; ?>
                            </div>
                            <div class="col-lg-3">
                            {{ $user_activity["updated_at"] -> diffForHumans() }}
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection