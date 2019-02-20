@extends('layouts/admin_layout')
@section('pagetitle','Users | FELS')
@section('content')
<div class="container">
    <div class="row mt-lg-5">
    <div class="col-lg-3"></div>
        <div class="col-lg-6">
            @yield('form_top')
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" placeholder="Ninja" @yield('delete_page_readonly') value="@yield('name_value')" @yield('required','required')>
                    @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">E-mail</label>
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" name="email" placeholder="Ninja@fels.com" @yield('delete_page_readonly') value="@yield('email_value')" @yield('required','required')>
                    @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="6 or more letters" @yield('required','required') @yield('readonly','')>
                    @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="">Password confirmation</label>
                    <input class="form-control" type="password" name="password_confirmation" placeholder="input the same of Password" @yield('required','required') @yield('readonly','')>
                </div>
                    <button class="btn btn-@yield('button_color','primary') mt-lg-4" type="submit">@yield('button_text','Create')</button>
                </div>
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>
@endsection