@extends('layouts/admin_layout')
@section('pagetitle','Categories | FELS')
@section('content')
<div class="container">
    <div class="row mb-lg-3"">
        <div class="">
            <h2>Categories</h2>
        </div>
    </div>
    <div class="
        row">
        <div class="col-lg-12" style="height:500px;">
            <table class="table table-hover">
                <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Action</td>
                </tr>
                @foreach($five_categories_data as $five_category_data)
                <tr>
                    <td>{{$five_category_data->title}}</td>
                    <td>{{$five_category_data->description}}</td>
                    <td>
                        <a href="">Add word</a> | <a href="/admin/category/edit/{{$five_category_data->id}}">Edit</a> | <a href="/admin/category/delete_view/{{$five_category_data->id}}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="row">
        <div class="pull-right">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="/admin/categories/1">TOP</a></li>
                    @if($page_number == 1)
                    @for($i = 0; $i < 5; $i++) <li class="page-item">
                        <a class="page-link active" href="/admin/categories/{{$page_number + $i}}">{{$page_number+
                            $i}}</a>
                        </li>
                        @endfor
                        @elseif($page_number == 2)
                        @for($i = -1; $i < 4; $i++) <li class="page-item">
                            <a class="page-link active" href="/admin/categories/{{$page_number + $i}}">{{$page_number+
                                $i}}</a>
                            </li>
                            @endfor
                            @else
                            @for($i = -2; $i < 3; $i++) <li class="page-item">
                                <a class="page-link active" href="/admin/categories/{{$page_number + $i}}">{{$page_number+
                                    $i}}</a>
                                </li>
                                @endfor
                                @endif
                                <li class="page-item"><a class="page-link" href="/admin/categories/{{$page_number + 1}}">NEXT</a></li>

                </ul>
            </nav>

        </div>
    </div>

</div>
@endsection