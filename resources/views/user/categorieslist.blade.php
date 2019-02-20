@extends('layouts/layout')
@section('pagetitle','Categories | FELS')
@section('content')

<div class="container">
    <div class="row">
        @foreach($categories as $category)
        <div class="col-lg-6 mb-lg-3">
        <div class="border col-lg-11">
            <div class="mt-lg-3">
                <h3>{{$category->title}}</h3>
            </div>
            <div class="mb-lg-3">
                {{$category->description}}
            </div>
            <div class="mb-lg-3 text-right">
                <a href="lesson/{{$category->id}}"><button class="btn btn-primary">Start</button></a>
            </div>
        </div>
        </div>

        @endforeach
    </div>

</div>

@endsection