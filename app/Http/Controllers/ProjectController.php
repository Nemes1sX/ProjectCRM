<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Requests\ImportProjectRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\ProjectRequest;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

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


    public function importProjects(ImportProjectRequest $request, $company_id){
        $path = $request->file('import_file')->getRealPath();

        $data = array_map('str_getcsv', file($path));

        $csvData = array_slice($data, 1);

        for($i=0; $i<count($csvData); $i++){
            Project::create([
               'name' => $csvData[$i][0],
                'description' => $csvData[$i][1],
                'startdate' => $csvData[$i][2],
                'enddate' => $csvData[$i][3],
                'company_id' => $company_id,
            ]);
        }

        return response()->json(['status' => 'Upload successfully'], 200);
    }

    public function exportProjects($company_id, $companyName){

        $fileName = $companyName.'.csv';

        $projects = Company::find($company_id)->with('projects');


        $columns = array('Name', 'Description', 'Start Date', 'End Date');

        $file = fopen($fileName, 'w');

        fputcsv($file, $columns);
            foreach ($projects as $project){
               $row['Name'] = $project->name;
               $row['Description'] = $project->description;
               $row['Start Date'] = $project->startdate;
               $row['End Date'] = $project->enddate;

               fputcsv($file, $row['Name'], $row['Description'], $row['Start Date'], $row['End Date']);
            }

            fclose($file);



        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($file, $companyName.'.csv', $headers);
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
