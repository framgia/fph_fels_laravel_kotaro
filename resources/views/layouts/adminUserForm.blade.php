@extends('layouts/adminDashboard')
@section('body')
<div class="container mt-4">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form action="/admin/add/user/store" method="POST">
                @csrf
                <label for="name">Name</label>
                <input class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" type="text" name="name" value="{{old('name')}}" minlength="3" maxlength="20" placeholder="Mt.Fuji" required autofocus>
                @if($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
                <label class="mt-3" for="email">E-mail</label>
                <input class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" type="mail" name="email" value="{{old('email')}}" placeholder="sushi@edo.com" required>
                @if($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
                <label class="mt-3" for="password">Password</label>
                <input class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" type="password" name="password" placeholder="min-letters: 6" minlength="6" required>
                @if($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
                <label class="mt-3" for="password">Password confirmation</label>
                <input class="form-control" type="password" name="password_confirmation" placeholder="input new Password again" minlength="6" required>
                <button class="mt-5 form-control btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="ciol-2"></div>
    </div>
</div>
@endsection 