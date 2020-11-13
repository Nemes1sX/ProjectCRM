<?php

namespace App\Http\Controllers;

use
    App\Http\Requests\ProjectRequest;
use App\Project;
use function GuzzleHttp\Promise\task;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::with('company')->get();

        return response()->json(['status' => 'success', 'projects' => $projects], 200);
    }

 /*   public function showCalendar()
    {
        $projects = Project::with('company')->get(['name', 'startdate', 'enddate']);

        return response()->json(['status' => 'success', 'projects' => $projects], 200);
    }*/

    public function showTasks($id){

        $tasks = Project::find($id)->tasks()->orderBy('order')->select('id','name','order','status')->get();

        $tasksCompleted = $tasks->filter(function ($task, $key) {
            return $task->status;
        })->values();

        $tasksNotCompleted = $tasks->filter(function ($task, $key) {
           return ! $task->status;
        })->values();


        return response()->json(['status' => 'success',
            'tasksCompleted' => $tasksCompleted,
            'tasksNotCompleted' => $tasksNotCompleted], 200);
    }

    public function create(ProjectRequest $request)
    {
        $project = new Project();

        $this->save($project, $request);

        return response()->json(['status' => 'success', 'data' => $request], 200);
    }

    public function findProject($id)
    {
        $project = Project::find($id)->company;

        return response(['status' => 'success', 'projects' => $project], 200);
    }

    public function updateProject(ProjectRequest $request, $id)
    {
        $project = Project::find($id)->company;

        $this->save($project, $id);

        return response()->json(['status' => 'success', 'project' => $request], 200);
    }

    public function delete($id)
    {
        $project = Project::find($id);

        $project->delete();

        return response()->json(['status' => 'success', 'data' => $id], 200);
    }

    private function save(Project $project, ProjectRequest $request)
    {
        $project->name = $request->name;
        $project->company_id = $request->company_id;
        $project->description = $request->description;
        $project->startdate = $request->startdate;
        $project->enddate = $request->enddate;

        $project->save();


    }

}
