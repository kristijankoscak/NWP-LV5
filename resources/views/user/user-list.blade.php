@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row bg-white border p-2">
            <div class="col">
              Name
            </div>
            <div class="col">
              Role
            </div>
            <div class="col">
              Action
            </div>
        </div>
        @foreach($users as $user)
        
            <form action="{{url('admin/user/' . $user->id)}}" method="POST" >
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="row bg-white border p-2">
                    <div class="col">
                        {{$user->name}}
                    </div>
                    <div class="col">
                        <select class="form-control" id="user-role" name="user-role">
                            <option {{$user->role == 'Student' ? 'selected' : ''}}>Student</option>
                            <option {{$user->role == 'Professor' ? 'selected' : ''}}>Professor</option>
                            <option {{$user->role == 'Admin' ? 'selected' : ''}}>Admin</option>
                        </select>
                    </div>
                    <div class="col">
                        <button type="submit" id="update-user-{{ $user->id }}" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div> 
            </form>
        
        @endforeach
        
</div>
@endsection