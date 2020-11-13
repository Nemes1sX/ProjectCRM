<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                'name' => 'Sveikas',
                'description' => 'Sveikas',
                'startdate' => '2020-11-13',
              'enddate' => '2020-11-20',
              'project_id' => 1
            ],
        ];
        foreach($tasks as $task){
            \App\Task::create($task);
        }
    }
}
