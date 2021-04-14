<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
       $tasksBacklog = Task::where('status', '=', 0)->count();
       $tasksToDo = Task::where('status', '=', 1)->count();
       $tasksInProgress = Task::where('status', '=', 2)->count();
        $tasksCompleted = Task::where('status', '=', 3)->count();


        return response()->json(['status' => 'success',
            'tasksBacklog' => $tasksBacklog,
            'tasksToDo' => $tasksToDo,
            'tasksInProgress' => $tasksInProgress,
            'tasksCompleted' => $tasksCompleted,
     ], 200);

    }
    public function getTasks()
    {
        $taskMan = 0;
        $tasksManager = User::withCount('tasks')->where('role', '=', 'Manager')->get();
        foreach ($tasksManager as $taskManager) {
            $taskMan += $taskManager->tasks_count;
        }
        $taskSoft = 0;
        $tasksSoftwareEngineer = User::withCount('tasks')->where('role', '=', 'Software Engineer')->get();
        foreach ($tasksSoftwareEngineer as $taskSoftwareEngineer) {
            $taskSoft += $taskSoftwareEngineer->tasks_count;
        }
        $taskIT = 0;
        $tasksITEngineer = User::withCount('tasks')->where('role', '=', 'IT Engineer')->get();
        foreach ($tasksITEngineer as $taskITEngineer) {
            $taskIT += $taskITEngineer->tasks_count;
        }

        return response()->json(['tasksManager' => $taskMan,
         'tasksItEngineer' => $taskIT,
         'tasksSoftwareEngineer' => $taskSoft], 200);
    }
}

