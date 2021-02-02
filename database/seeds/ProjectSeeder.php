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
              'startdate' => '2020-11-13',
              'enddate' => '2020-11-20',
              'company_id' => 1
          ],
           [
               'name' => 'Testas',
               'description' => 'Hello world',
               'startdate' => '2021-01-24',
               'enddate' => '2021-02-05',
               'company_id' => 4
               ],
            [
            'name' => 'Padidinti užsakymus',
            'description' => 'Atlikti projektus',
            'startdate' => '2020-01-25',
            'enddate' => '2021-01-28',
            'company_id' => 3
            ],
        ];
        foreach($projects as $project){
            \App\Project::create($project);
        }
    }
}
