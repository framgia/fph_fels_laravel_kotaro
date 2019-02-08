@extends('layouts/layout')
@section('pagetitle','Profile | FELS')
@section('content')

<div class="container">
    <div class="row">
        <div class="border col-lg-2">
            <div>
                <div class="border">
                    <img src="{{asset('storage/' . $user_data['avatar_url'])}}" alt="" class="img-thumbnail">
                </div>
                <div class="border">
                    <div>
                        {{$user_data['name']}}
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            {{$followed_number}}<br>
                            followed<br>
                        </div>
                        <div class="col-lg-6">
                            {{$follower_number}}<br>
                            follower<br>
                        </div>
                    </div>
                </div>
                <div class="border">
                    @if($followed_exists == 0)
                    <form action="{{$user_data['id']}}/follow" method="POST">
                        @csrf
                        <button class="btn" name="follow_id">follow</button>
                    </form>
                    @elseif($followed_exists == 1)
                    <form action="{{$user_data['id']}}/unfollow" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">unfollow</button>
                    </form>
                    @elseif($user_data['id'] == Auth::id())
                    @endif
                </div>
                <div>
                    <a href="/user/learnedwordslist/{{$user_data['id']}}">Learned {{$learned_words_number}} words</a>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
        </div>
        <div class="border col-lg-8">
            <div>
                <div class="border ">
                    Activities
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
                                {{$user_activity['updated_at']->diffForHumans()}}
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