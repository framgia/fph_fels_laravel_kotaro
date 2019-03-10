@extends('layouts/admindashboard')
@section('body')
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            @yield('formHeader')
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control {{$errors->has('title') ? ' is-invalid' : ''}}" type="text" name="title" value="{{$category->title}}" placeholder="E-learning system" required autofocus @yield('readonly','')>
                @if($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
                @endif
                <label class="mt-3" for="description">Description</label>
                <textarea type="text" class="form-control {{$errors->has('description') ? ' is-invalid' : ''}}" name="description" id="" cols="30" rows="10" placeholder="something something..." required @yield('readonly','')>{{$category->description}}</textarea>
                @if($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
                <button type="submit" class="btn btn-@yield('buttonColor','success') mt-5 form-control">@yield('buttonText','Edit')</button>
            </div>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>
</div>
@endsection 