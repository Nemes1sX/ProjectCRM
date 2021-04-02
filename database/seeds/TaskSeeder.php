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
                'estimated_time' => 1,
                'project_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Sveiki',
                'description' => 'Sveiki',
                'startdate' => '2021-01-25',
                'enddate' => '2021-01-28',
                'estimated_time' => 1,
                'project_id' => 3,
                'user_id' => 3
            ],
            [
                'name' => 'Sveikas',
                'description' => 'Sveikas',
                'startdate' => '2021-01-25',
                'enddate' => '2020-01-28',
                'estimated_time' => 1,
                'project_id' => 3,
                'user_id' => 3
            ],
        ];
        foreach ($tasks as $task) {
            \App\Task::create($task);
        }
    }
}
