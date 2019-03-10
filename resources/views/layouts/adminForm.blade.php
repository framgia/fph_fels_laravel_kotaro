@extends('layouts/admindashboard')
@section('body')
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="/admin/category/{{$category->id}}/restore" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control {{$errors->has('title') ? ' is-invalid' : ''}}" type="text" name="title" value="{{$category->title}}" placeholder="E-learning system" required autofocus>
                    @if($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                    <label class="mt-3" for="description">Description</label>
                    <textarea type="text" class="form-control {{$errors->has('description') ? ' is-invalid' : ''}}" name="description" id="" cols="30" rows="10" placeholder="something something..." required>{{$category->description}}</textarea>
                    @if($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                    @endif
                    <button type="submit" class="btn btn-success mt-5 form-control">Edit</button>
                </div>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>
</div>
@endsection 