<?php

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
          [
           'name' => 'Sveikas',
              'description' => 'Sveikas',
              'status' => 'To-do',
              'startdate' => '2020-11-13',
              'enddate' => '2020-11-20',
              'company_id' => 1
          ],
        ];
        foreach($projects as $project){
            \App\Project::create($project);
        }
    }
}
