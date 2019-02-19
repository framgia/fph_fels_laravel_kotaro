@extends('layouts/layout')
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
                    <td style="width:200px;">

                    </td>
                </tr>
            </thead>
            <tbody>
                @yield('tbody','')
            </tbody>
        </table>
    </div>
</div>
@endsection