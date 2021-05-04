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
                    {{ $task->assignee }}
                </div>
            </div>
            <span>Student applications: </span>
            @if(count($task->applicationStudents)>0)
                @foreach($task->applicationStudents as $student)
                    <div class="row bg-light border p-2">
                        <div class="col">
                            ID: [{{ $student->id }}]
                        </div>
                        <div class="col">
                            {{ $student->name }}
                        </div>
                        <div class="col">
                            {{ $student->email }}
                        </div>
                        <div class="col">
                            <a href="{{ route('assignee.task',['taskId'=> $task->id, 'operation'=>'approve', 'studentId' => $student->id]) }}">
                                <button type="submit" class="btn btn-success" {{$student->id == $task->assignee ? 'disabled' : ''}}>
                                    Approve
                                </button>
                            </a>
                            <a href="{{ route('assignee.task',['taskId'=> $task->id, 'operation'=>'deny', 'studentId' => $student->id]) }}">
                                <button type="submit" class="btn btn-danger" >
                                    Deny
                                </button>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <span>No student applications for this task.</span>
            @endif
            <br>
        @endforeach
    @else
        <span>There is no tasks.</span>
    @endif
</div>
@endsection