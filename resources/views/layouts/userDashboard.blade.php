<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('pageTitle','FELS')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/app.css')}}">
    <script src="main.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/dashboard">FELS</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="ナビゲーションの切替">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/profile/{{auth()->user()->id}}/learnedwords">Learned words</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/profile/{{auth()->user()->id}}/learnedlessons">Learned lessons</a>
                </li>
                <li class="nav-item  active">
                    <a class="nav-link" href="/profile/{{auth()->user()->id}}">Profile</a>
                </li>
            </ul>
            <span class="navbar-text">
                <a class="nav-link" href="logout">Logout</a>
            </span>
        </div>
    </nav>
    <div class="container mt-lg-4">
        <div class="row">
            <div class="col-lg-3 mt-lg-5">
                <div class="border shadow">
                    <div class="m-lg-3">
                        <div class="w-50 h-50 mt-lg-5 mb-lg-4 mx-auto rounded-circle border">
                            <img src="{{asset('storage/'.$user->avatar_url)}}" alt="" class="img-fluid rounded-circle">
                        </div>
                        <div class="text-lg-center mb-lg-4">
                            <span class="lead mx-auto"><strong>{{$user->name}}</strong></span>
                        </div>
                        <div class="mb-lg-2">
                            <a href="/profile/{{$user->id}}/learnedwords">Learned {{$user->learnedWord->count()}} words</a>
                        </div>
                        <div class="mb-lg-2">
                            <a href="/profile/{{$user->id}}/learnedlessons">Learned {{$user->learnedLesson->count()}} lessons</a>
                        </div>
                        <div>
                            @if($user->id == auth()->user()->id)
                            @else
                            @if(Auth::user()->checkRelationship($user->id))
                            <form action="/relationship/unfollow" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger form-control" type="submit" name="id" value="{{$user->id}}">Unfollow</button>
                            </form>
                            @else
                            <form action="/relationship/follow" method="POST">
                                @csrf
                                <button class="btn btn-primary form-control" type="submit" name="id" value="{{$user->id}}">Follow</button>
                            </form>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8">
                @yield('content')
            </div>

        </div>

    </div>
</body>

</html> 