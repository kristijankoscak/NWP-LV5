@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.content') !!}
                    </div>
                @endif
                
                <div class="card-header">{{$userRole}}  {{ __('dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($userRole == 'Student')
                        <a class="dropdown-item" href="{{ route('show.tasks') }}">Show tasks</a>
                    @elseif($userRole == 'Professor')
                        <a class="dropdown-item" href="{{ route('select.lang') }}">Add task</a>
                        <a class="dropdown-item" href="{{ route('show.tasks') }}">Show my tasks</a>
                        <a class="dropdown-item" href="{{ route('show.applications') }}">Show assignments</a>
                    @elseif($userRole == 'Admin')
                        <a class="dropdown-item" href="{{ route('show.user.list') }}">Users</a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
