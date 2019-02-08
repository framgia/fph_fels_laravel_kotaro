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
                            following<br>
                        </div>
                        <div class="col-lg-6">
                            {{$follower_number}}<br>
                            following<br>
                        </div>
                    </div>
                </div>
                <div class="border">
                    <form action="{{$user_data['id']}}/follow" method="POST">
                        @csrf
                        <button class="btn" name="follow_id">follow</button>
                    </form>
                    <form action="{{$user_data['id']}}/unfollow" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">unfollow</button>
                    </form>
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