<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskOrderRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Task;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;


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

        $this->save($request, $task);

        return response()->json(['status' => 'success'], 200);

    }

    public function findTask($id)
    {
        $task = Task::find($id)->project;

        return response()->json(['status' => 'success', 'task' => $task], 200);
    }

    public function updateTask(TaskRequest $request, $id, $role)
    {
        $task = Task::find($id)->project;

        $this->save($request, $task);

        return response()->json(['status' => 'success'], 200);
    }

    public function updateTaskStatus(TaskStatusRequest $request, $id){

        $task = Task::find($id);
        $task->status = $request->status;
        $task->save();

        return response()->json(['status' => 'success'], 200);
    }

    public function updateTaskOrder(TaskOrderRequest $request)
    {
        $tasks = Task::all();

        foreach ($tasks as $task){
            $id = $task->id;
            foreach($request->tasks as $tasksNew){
                if($tasksNew['id'] == $id){
                    $task->update(['order' => $tasksNew['order']]);
                }
            }
        }

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

        $response = Http::post('http://localhost:5000/results',[
            'title' => $request->description
        ]);


        $response = json_decode($response->body());
        $role = $response->role;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->user_id =  User::where('role', $role)->inRandomOrder()->first()->id;
        $task->project_id = $request->project_id;
        $task->startdate = $request->startdate;
        $task->enddate = $request->enddate;

        $task->save();
    }
}
