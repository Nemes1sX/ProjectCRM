<?php

namespace App\Http\Controllers;

use App\Company;
use App\Exports\ProjectExport;
use App\Http\Requests\ImportProjectRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\ProjectRequest;
use App\Imports\ProjectImport;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ProjectController extends Controller
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

        $projects = Project::with('company:id,name')->orderBy($sortField, $sortDirection)->get();

        return response()->json(['status' => 'success', 'projects' => $projects], 200);
    }

    public function showCalendar(Request $request)
    {
        $projects = Project::get(['name', 'startdate']);

        return response()->json(['status' => 'success', 'projects' => $projects], 200);
    }

    public function showTasks($id){

        $tasks = Task::with('user:id,name,role')->where('project_id' , '=' , $id)->orderBy('order')->get();

        $tasksCompleted = $tasks->filter(function ($task, $key) {
            return $task->status == 3;
        })->values();

        $tasksInProgress = $tasks->filter(function ($task, $key) {
            return $task->status == 2;
        })->values();

        $tasksToDo = $tasks->filter(function ($task, $key) {
           return $task->status == 1;
        })->values();

        $tasksBacklog = $tasks->filter(function ($task, $key) {
            return $task->status == 0;
        })->values();

        return response()->json(['status' => 'success',
            'tasksBacklog' => $tasksBacklog,
            'tasksCompleted' => $tasksCompleted,
            'tasksToDo' => $tasksToDo,
            'tasksInProgress' => $tasksInProgress], 200);
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


    public function importProjects($company_id, ImportProjectRequest $request){

        $path = $request->file('file')->getRealPath();

       Excel::import(new ProjectImport($company_id), $path);

        return response()->json(['status' => 'Upload successfully'], 200);

    }

    public function exportProjects($company_id){

        return Excel::download(new ProjectExport($company_id),  'projects.xlsx');
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
