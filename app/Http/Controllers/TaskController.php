<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use App\Project;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('project')->get();

        return response()->json(['status' => 'success', 'tasks' => $tasks], 200);
    }

    public function create(TaskRequest $request)
    {
        $task = new Task();

        if((Project::find($request->project_id)->enddate < $request->enddate) || (Project::find($request->project_id)->startdate > $request->startdate))
            return response()->json(['error' => 'Task dates does not match project dates'], 422);

        $this->save($request, $task);

        return response()->json(['status' => 'success'], 200);
    }

    public function findTask($id)
    {
        $task = Task::find($id)->project;

        return response()->json(['status' => 'success', 'task' => $task], 200);
    }

    public function updateTask(TaskRequest $request, $id)
    {
        $task = Task::find($id)->project;

        $this->save($task, $request);

        return response()->json(['status' => 'success'], 200);
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);

        $task->delete();

        return response()->json(['status' => 'success'], 200);
    }

    private function save(TaskRequest $request, Task $task)
    {
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->project_id = $request->project_id;
        $task->startdate = $request->startdate;
        $task->enddate = $request->enddate;

        $task->save();
    }
}
