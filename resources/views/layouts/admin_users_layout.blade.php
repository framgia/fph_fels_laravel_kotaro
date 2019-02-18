@extends('layouts/admin_layout')
@section('pagetitle','Users | FELS')
@section('content')
<div class="container">
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>
                        Name
                    </td>
                    <td>
                        E-mail
                    </td>
                    <td>

                    </td>
                </tr>
            </thead>
            <tbody>
                @yield('tbody','')
            </tbody>
        </table>
    </div>
    <div class="mt-lg-5">
        <a href="/admin/user/add"><button class="btn btn-primary">+ add account</button></a>
    </div>
</div>
@endsection