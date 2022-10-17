@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if (\Session::has('message'))
                    <div class="error">{!! \Session::get('message') !!}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-header">
                    {{ __('message.users') }}
                    @can('work_with_users',Auth::user())
                        <a class="btn btn-success" style="float: right;" href="/users/create" role="button">+ New</a>
                    @endcan    
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Asignee Email</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supervisors as $supervisor)
                            <tr>
                                <td>{{ $supervisor->first_name }}</td>
                                <td>{{ $supervisor->last_name }}</td>
                                <td>{{ $supervisor->email }}</td>
                                @foreach ($supervisor->assignees as $asignee)
                                     <td>{{ $asignee->email }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection