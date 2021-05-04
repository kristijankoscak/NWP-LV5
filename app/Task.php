<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'name', 
        'name_en', 
        'assignment',
        'study_type',
        'professor_id',
        'assignee'
        
    ];
    
    public function students(){
        return $this->belongsToMany(User::class, "task_user", "task_id", "student_id");
    }

    public function getAssignee(){
        if($this->assignee!=null)
            return User::find($this->assignee);
        return null;
    }
}
