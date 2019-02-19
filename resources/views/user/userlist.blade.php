@extends('layouts/user_userlist_layout')
@section('pagetitle','User list | FELS')
@section('tbody')
@foreach($ten_users as $user)
<tr>
    <td>
        <div style="width:75px; height:75px;">
        <img src="{{asset('storage/' . $user->avatar_url)}}" alt="" class="img-thumbnail img-responsive">
        </div>
    </td>
    <td>
            <a  href="/user/profile/{{$user->id}}">{{$user->name}}</a>
    </td>
    <td>
        {{$user->email}}
    </td>
    <td>
    <div class="">
                    @if($user->followed == 0)
                    <form action="/user/userlist/{{$user->id}}/follow" method="POST">
                        @csrf
                        <button class="btn btn-primary" name="follow_id">follow</button>
                    </form>
                    @elseif($user->followed == 1)
                    <form action="/user/userlist/{{$user->id}}/unfollow" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-info" type="submit">unfollow</button>
                    </form>
                    @elseif($user->followed == 2)
                    @endif
                </div>
    </td>
</tr>
@endforeach
<div class="row">
        <div class="pull-right">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="/user/userlist/1">TOP</a></li>
                    @if($page_number == 1)
                    @for($i = 0; $i < 5; $i++) <li class="page-item">
                        <a class="page-link active" href="/user/userlist/{{$page_number + $i}}">{{$page_number+
                            $i}}</a>
                        </li>
                        @endfor
                        @elseif($page_number == 2)
                        @for($i = -1; $i < 4; $i++) <li class="page-item">
                            <a class="page-link active" href="/user/userlist/{{$page_number + $i}}">{{$page_number+
                                $i}}</a>
                            </li>
                            @endfor
                            @else
                            @for($i = -2; $i < 3; $i++) <li class="page-item">
                                <a class="page-link active" href="/user/userlist/{{$page_number + $i}}">{{$page_number+
                                    $i}}</a>
                                </li>
                                @endfor
                                @endif
                                <li class="page-item"><a class="page-link" href="/user/userlist/{{$page_number + $i}}">NEXT</a></li>

                </ul>
            </nav>

        </div>
    </div>
@endsection