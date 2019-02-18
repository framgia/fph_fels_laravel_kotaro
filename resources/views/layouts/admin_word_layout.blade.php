@extends('layouts/admin_layout')
@section('pagetitle','Category add word | FELS')
@section('content')
<div class="container">
<div class="col-lg-12 mb-lg-4"><h2>@yield('subtitle','Add') word</h2></div>
@yield('form_header')
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <label for="">Word</label>
            </div>
            <div class="col-lg-5">
                <label for="">Choice</label>
            </div>
            <div class="col-lg-1">Answer</div>
        </div>
            <div class="row">
                <div class="col-lg-5 form-group">
                    <input class="form-control" type="text" name="word" id="" placeholder="input word..." @yield('readonly','') @yield('required','required') value="@yield('word','')">
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <input class="form-control mb-lg-3" type="text" name="choice1" placeholder="input choice..." @yield('readonly','') @yield('required','required') value="@yield('answer','')">
                    <input class="form-control mb-lg-3" type="text" name="choice2" placeholder="input choice..." @yield('readonly','') @yield('required','required') value="@yield('wrong_answer_1','')">
                    <input class="form-control mb-lg-3" type="text" name="choice3" placeholder="input choice..." @yield('readonly','') @yield('required','required') value="@yield('wrong_answer_2','')">
                    <input class="form-control mb-lg-5" type="text" name="choice4" placeholder="input choice..." @yield('readonly','') @yield('required','required') value="@yield('wrong_answer_3','')">
                    <button class="form-control btn btn-@yield('button_color','primary')">@yield('button_text','submit')</button>
                </div>
                <div class="col-lg-1">
                    <div class="radio mb-lg-3 mt-lg-1 pt-lg-1 pb-lg-2">
                        <input class="radio" name="answer" type="radio" value="choice1" @yield('disabled','') @yield('required','required') @yield('checked','')>
                    </div>
                    <div class="radio mb-lg-3 mt-lg-1 pt-lg-1 pb-lg-2">
                        <input class="radio" name="answer" type="radio" value="choice2" @yield('disabled','') required>
                    </div>
                    <div class="radio mb-lg-3 mt-lg-1 pt-lg-1 pb-lg-2">
                        <input class="radio" name="answer" type="radio" value="choice3" @yield('disabled','') required>
                    </div>
                    <div class="radio mb-lg-3 mt-lg-1 pt-lg-1 pb-lg-2">
                        <input class="radio" name="answer" type="radio" value="choice4" @yield('disabled','') required>
                    </div>
                </div>
            </div>
    </form>
</div>
@endsection