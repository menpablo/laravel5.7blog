<?php
$route  = empty($user->id) ? 'users.store' : 'users.update';
$params = empty($user->id) ? [] : ['user' => $user->id];

?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-header">{{ __('message.create_user') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route($route, $params) }}">
                        @csrf
                        @if(!empty($user->id ))
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $user->id  }}">
                        @endif

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('message.first_name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name', !empty($user->first_name)?$user->first_name:null ) }}" required autofocus>

                                @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('message.last_name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name', !empty($user->last_name)?$user->last_name:null) }}" required autofocus>

                                @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email',!empty($user->email)?$user->email:null) }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('message.user_type') }}</label>
                            <div class="col-sm-6">
                                <select id="user_type" name="user_type" style="border: 1px #8a8a8a solid; color: black" class=" form-control" required>
                                    <option value="" disabled selected>Select your option</option>
                                    @foreach($roles as $role)
                                        @if(!empty($user->id ) && $user->role->exists() && $user->role->id == $role->id || $role->id == old('user_type'))
                                            <option value="{{$role->id}}" selected>{{$role->description}}</option>
                                        @else
                                            <option value="{{$role->id}}"> {{$role->description}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="supervisor_div" class="form-group row" style="display: none;" >
                            <label for="supervisor_id" class="col-md-4 col-form-label text-md-right">{{ __('message.supervisor') }}</label>
                            <div class="col-sm-6">
                                <select id="supervisor_id" name="supervisor_id" style="border: 1px #8a8a8a solid; color: black" class=" form-control">
                                    <option value="" disabled selected>Select your option</option>
                                    @foreach($supervisors as $supervisor)
                                        @if(!empty($supervisor->id ) && !empty($user->id ) && $user->supervisor()->exists() && $user->supervisor->exists() && ($user->supervisor->id == $supervisor->id || $supervisor->id == old('supervisor_id')))
                                            <option value="{{$supervisor->id}}" selected>{{$supervisor->first_name." ".$supervisor->last_name}}</option>
                                        @else
                                            <option value="{{$supervisor->id}}">{{$supervisor->first_name." ".$supervisor->last_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @can('work_with_users',Auth::user())
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('message.save') }}
                                    </button>
                                </div>
                            </div>
                        @endcan                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection