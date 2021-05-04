<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Task;

use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    //

    public function index(Request $request){
        $loggedUser = $request->user();
        $tasks = [];

        if($loggedUser->role == 'Professor'){
            $tasks = Task::where('professor_id', '=', $loggedUser->id)->get();
        }
        else{
            $tasks = Task::orderBy('created_at','asc')->get();
            foreach($tasks as $task){
                if($task->assignee == null) {
                    $task->assignee = '-';
                }
                if($task->students->contains($loggedUser->id)){
                    $task->assigned = true;
                }
                else{
                    $task->assigned = false;
                }
            }

        }
        return view('task.list',[
            'loggedUser' => $loggedUser,
            'tasks' => $tasks
        ]);
       
    }

    public function showTaskForm(Request $request, $locale){
        app()->setLocale($locale);
        return view('task.form');
    }

    public function store(Request $request){
        $this->validateInputs($request);
        $task = new Task();
        $task->name = $request->input('name');
        $task->name_en = $request->input('name_en');
        $task->study_type = $request->input('study_type');
        $task->assignment = $request->input('assignment');
        $task->professor_id = Auth::user()->id;
        $task->save();
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Task is successfully added!');

        return redirect()->route('home');
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();
  
        return redirect()->route('show.tasks');
    }

    public function assigneeTask(Request $request, $taskId , $operation, $studentId){
        $student = User::find($studentId);
        $task = Task::find($taskId);

        if($operation == 'approve'){
            $studentsAppliedForTask = $task->students()->get();
            foreach($studentsAppliedForTask as $appStudent){
                if($appStudent->id != $student->id){
                    $task->students()->detach($appStudent);
                }
            }
            $studentOtherAppliedTasks = $student->tasks()->get();
            foreach($studentOtherAppliedTasks as $studentTask){
                if($studentTask->id != $task->id){
                    $tempTask = Task::find($studentTask->id);
                    $tempTask->assignee = null;
                    $tempTask->save();
                    $student->tasks()->detach($studentTask);
                }
            }
            $task->assignee = $student->id;
            $task->save();
        }
        else{
            $studentsAppliedForTask = $task->students()->get();
            foreach($studentsAppliedForTask as $appStudent){
                if($appStudent->id == $student->id){
                    $task->students()->detach($appStudent);
                }
            }
            $task->assignee = null;
            $task->save();
        }
        
        
        return redirect()->route('show.applications');;
    }

    public function storeTaskApplication(Request $request){
        $loggedUser = Auth::user();
        if($request->detach != null){
            $task = Task::find($request->detach);
            $loggedUser->tasks()->detach($task);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'You successfully remove application.');
        }
        else{
            $task = Task::find($request->attach);
            $loggedUser->tasks()->attach($task);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'You successfully applied to task.');
        }
        return redirect()->route('show.tasks');
    }

    public function showTaskApplications(Request $request){
        $loggedUser = Auth::user();
        $tasks = Task::all()->where('professor_id','=',$loggedUser->id);
        foreach($tasks as $task){
            if($task->assignee == null){
                $task->assignee = '/';
            }
            $task->applicationStudents = $task->students()->get();

        }
        

        return view('assignments',[
            'tasks' => $tasks
        ]);
    }
    
    public function selectLang(){
        return view('select-lang');
    }


    public function validateInputs(Request $request){
        $this->validate(
            $request, 
            [
                'name' => 'required|max:255',
                'name_en' => 'required|max:255',
                'assignment' => 'required|max:255',
                'study_type' => 'required'
            ],
            [
                'required' => 'This field is required!'
            ]
        );
    }
}
