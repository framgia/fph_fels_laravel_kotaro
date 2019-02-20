@extends('layouts/admin_layout')
@section('pagetitle','Categories | FELS')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="">
                        <form action="/admin/category/@yield('method','store')/@yield('category_id','')" method="POST">
                        @csrf
                        @yield('method_add','')
                            <div class="form-group">
                                <label for="exampleInputTitle">Title</label>
                                <input class="form-control" type="text" name="title" value="@yield('title','')" placeholder="title" @yield('required','required') @yield('readonly','')>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputDescription">Description</label>
                                <textarea class="form-control" name="description" cols="30" rows="10" placeholder="description" @yield('required','required') @yield('readonly','')>@yield('description','')</textarea>
                            </div>
                            <div>
                                <button class="btn btn-@yield('button_color','primary')" type="submit">@yield('button_text','Post')</button>
                            </div>
                        </form>
                    </div>
                </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
@endsection