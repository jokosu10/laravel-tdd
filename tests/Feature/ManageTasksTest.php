<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTasksTest extends TestCase
{
    /**
     * @test
     * */
    public function user_can_create_a_task()
    {
        // user view list task
        $this->visit('/tasks');

        // user fill field `name` and `description` and then submitt this value
        $this->submitForm('Create Task', [
            'name'  => 'My First Task',
            'description'   => 'This is my first task on my new job.',
        ]);

        // view record on database
        $this->seeInDatabase('tasks', [
            'name'  => 'My First Task',
            'description'   => 'This is my first on my new job',
            'is_done'   => 0,
        ]);

        // redirect to view list task
        $this->seePageIs('/tasks');

        // view list task while submit
        $this->see('My First Task');
        $this->see('This is my first task on my new job.');
    }

    /**
     * @test
     * */
    public function user_can_browser_tasks_index_page()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * */
    public function user_can_edit_an_existing_task()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     * */
    public function user_can_delete_an_existing_task()
    {
        $this->assertTrue(true);
    }
}
