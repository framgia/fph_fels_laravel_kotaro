@extends('layouts/userDashboard')
@section('pageTitle','DashBoard | FELS')
@section('content')
<div class="border h-100 shadow">
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item text-light">
                    <span class="lead"><strong>Activities</strong></span>
                </li>
            </ul>
        </div>
    </nav>
    <div class="" style="height:500px; overflow:scroll;">
        <div class="ml-lg-4 mt-lg-4">
            @foreach($activities as $activity)
            <div class="mb-lg-3">
                {!!$activity['message']!!}<br>
                {{$activity['updated_at']->diffForHumans()}}<br>
            </div>
            @endforeach
        </div>
    </div>
</div>




@endsection 