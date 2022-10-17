@extends('layouts.app')

@section('content')
<div class="container">
    @include('modals.edit_profile')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
              
               
                <div class="card-body">
                
                    @if (\Session::has('message'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('message') !!}</li>
                            </ul>
                        </div>
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

                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="card-body ">
                        <div style="margin-left:100%">
                            <button href='#' data-toggle="modal" data-target="#edit_profile" style="border:none;background-color:white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                        </div>

                        <h5 class="card-title md-9">{{ $user->first_name }} {{ $user->last_name }}</h5>

                        <p class="card-text">{{ $user->email }}</p>
                        @if($user->supervisor()->exists())
                            <p class="card-text">Supervisor: {{ $user->supervisor->first_name }} {{ $user->supervisor->last_name }}</p>
                        @endif
                        @if($user->role->description ==  App\Enums\UserType::ADMIN)
                            <p class="card-text">Supervisors Quatity: {{$total_supervisors}}</p>
                            <p class="card-text">Bloggers Quatity: {{$total_bloggers}}</p>                          
                        @endif
                        
                        @if($user->role->description ==  App\Enums\UserType::SUPERVISOR)
                            <p class="card-text">Bloggers Quatity: {{$total_bloggers}}</p>                          
                        @endif

                        <p class="card-text">Blogs Quatity: {{$total_blogs}}</p>
                        <p class="card-text">Last Login: {{ $user->last_login }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection