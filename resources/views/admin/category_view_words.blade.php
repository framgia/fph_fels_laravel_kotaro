@extends('layouts/admin_layout')
@section('pagetitle','Categories | FELS')
@section('content')
<div class="container">
<table class="table table-hover">
    <thead>
        <tr>
            <td>word</td>
            <td>answer</td>
            <td>wrong answer 1</td>
            <td>wrong answer 2</td>
            <td>wrong answer 3</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach($ten_words as $word)
        <tr>
            <td>{{$word->word}}</td>
            <td>{{$word->answer}}</td>
            <td>{{$word->wrong_answer_1}}</td>
            <td>{{$word->wrong_answer_2}}</td>
            <td>{{$word->wrong_answer_3}}</td>
            <td><a href="/admin/category/edit_word/{{$word->id}}">Edit</a> | <a href="/admin/category/view_delete_word/{{$word->id}}">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
    <div class="row">
        <div class="pull-right">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="/admin/category/view_word/{{$category_id}}/1">TOP</a></li>
                    @if($page_number == 1)
                    @for($i = 0; $i < 5; $i++) <li class="page-item">
                        <a class="page-link active" href="/admin/category/view_word/{{$category_id}}/{{$page_number + $i}}">{{$page_number+
                            $i}}</a>
                        </li>
                        @endfor
                        @elseif($page_number == 2)
                        @for($i = -1; $i < 4; $i++) <li class="page-item">
                            <a class="page-link active" href="/admin/category/view_word/{{$category_id}}/{{$page_number + $i}}">{{$page_number+
                                $i}}</a>
                            </li>
                            @endfor
                            @else
                            @for($i = -2; $i < 3; $i++) <li class="page-item">
                                <a class="page-link active" href="/admin/category/view_word/{{$category_id}}/{{$page_number + $i}}">{{$page_number+
                                    $i}}</a>
                                </li>
                                @endfor
                                @endif
                                <li class="page-item"><a class="page-link" href="/admin/category/view_word/{{$category_id}}/{{$page_number + $i}}">NEXT</a></li>

                </ul>
            </nav>

        </div>
    </div>
</div>
@endsection