@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row bg-white border p-2">
        <div class="col">
            Task name (Croatian)
        </div>
        <div class="col">
            Task name (English)
        </div>
        <div class="col">
            Study type
        </div>
        <div class="col">
            Assignment
        </div>
        <div class="col">
            Assignee
        </div>
        <div class="col">
            Action
        </div>
    </div>
    @if(count($tasks)>0)
        @foreach($tasks as $task)
            <div class="row bg-white border p-2">
                <div class="col">
                    {{ $task->name }}
                </div>
                <div class="col">
                    {{ $task->name_en }}
                </div>
                <div class="col">
                    {{ $task->study_type }}
                </div>
                <div class="col">
                    {{ $task->assignment }}
                </div>
                <div class="col">
                    {{ $task->getAssignee()['email'] ? $task->getAssignee()['email'] : $task->assignee}}
                </div>
                @if($loggedUser->role == 'Student')
                    <div class="col">
                        <form action="{{route('store.task.application')}}" method="POST">
                            {{ csrf_field() }}
                            @if($task->assigned)
                            <button type="submit" class="btn btn-danger" name="detach" value={{ $task->id }} {{$task->assignee == $loggedUser->id ? 'disabled' : ''}}>
                                Remove assignment
                            </button>
                            @else
                            <button type="submit" class="btn btn-primary" name="attach" value={{ $task->id }} {{(($task->assignee != '-')) ? 'disabled' : ''}}>
                                Assign to
                            </button>
                            @endif
                            
                        </form>
                    </div>
                @endif

                @if($loggedUser->role == 'Professor')
                    <div class="col"> 
                        <form action="{{route('delete.task',['task'=> $task->id])}}" method="POST">
                            {{ csrf_field() }} 
                            {{ method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        
        @if($loggedUser->role == 'Student')
            <span>You have applications. There is no free tasks.</span>
        @else
            <span>There is no tasks.</span>
        @endif
    @endif
</div>
@endsection