<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskOrderRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Project;
use App\Task;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;


class TaskController extends Controller
{
    public function index()
    {

        $sortField = request('sort_field', 'name');
        if(!in_array($sortField, ['name', 'description', 'status', 'startdate', 'enddate'])){
            $sortField = 'created_at';
        }
        $sortDirection = request('sort_direction', 'desc');
        if(!in_array($sortDirection, ['asc', 'desc'])){
            $sortDirection = 'desc';
        }

        $tasks = Task::with('project:id,name','user:id,name,role')->orderBy($sortField, $sortDirection)->get();

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

    public function updateTask(TaskRequest $request, $id)
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

    private function assignTask($role)
    {
        $user = User::addSelect([
            'estimated_time' => Task::selectRaw('sum(estimated_time) as total')
                ->whereColumn('user_id', 'users.id')
                ->groupBy('user_id')
        ])
            ->where('role', $role)
            ->orderBy('estimated_time', 'asc')
            ->firstOrFail();


        return $user->estimated_time >= 18 ? null
            : $user->id;

    }

    private function save(TaskRequest $request, Task $task)
    {
        $response = Http::post('http://localhost:5000/results', [
            'title' => $request->description
        ]);

        $response = json_decode($response->body());
        $task->name = $request->name;
        $task->description = $request->description;
        $task->estimated_time = $request->estimated_time;
        $task->user_id = !$this->assignTask($response->role) ? '' : $this->assignTask($response->role);
        $task->project_id = $request->project_id;
        $task->status = !$task->user_id ? 1 : 0;
        $task->startdate = $request->startdate;
        $task->enddate = $request->enddate;

        $task->save();
    }
}
