<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class TaskUnitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function createTask()
    {
        $data =[
          'name' => $this->faker->word,
            'description' => $this->faker->word,
            'project_id' => 1,
            'start_date' => '2021-01-24',
            'end_date' => '2021-01-27'
        ];

        $taskRepo = new TaskRepository(new Task);
        $task = $taskRepo->createTask($data);

        $this->assertanceInstanceOf(Task::class, $task);
        $this->assertEquals($data['name'], $task->name);
        $this->assertEquals($data['description'], $task->description);
        $this->assertEquals($data['project_id'], $task->project_id);
        $this->assertEquals($data['start_date'], $task->start_date);
        $this->assertEquals($data['end_date'], $task->end_date);

        //$this->assertTrue(true);
    }
}
