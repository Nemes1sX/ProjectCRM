<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{

    use RefreshDatabase;

    public function test_create_task()
    {

        $this->seed();

        $response = $this->post('api/task/create', ['name' => 'Testas', 'description' => 'My Pc has BSOD too much', 'start_date' => '2021-01-24', 'end_date' => '2021-01-27', 'project_id' => 1]);

        $response->assertStatus(302)
                ->assertJson(['created' => true]);
    }
}
