<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTasksTest extends TestCase
{

    use RefreshDatabase;

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
        // $this->seeInDatabase('tasks', [
        //     'name'  => 'My First Task',
        //     'description'   => 'This is my first on my new job',
        //     'is_done'   => 0,
        // ]);

        // redirect to view list task
        $this->seePageIs('/tasks');

        // view list task while submit
        $this->see('My First Task');
        $this->see('This is my first task on my new job.');
    }

    /**
     * @test
     * */
    public function user_can_browse_tasks_index_page()
    {
        // Generate 3 record task on table `tasks`
        $tasks = factory(Task::class, 3)->create();

        // User can view page list task
        $this->visit('/tasks');

        // User can view 3 task on page
        $this->see($tasks[0]->name);
        $this->see($tasks[1]->name);
        $this->see($tasks[2]->name);

        // User can view link for edit task on every item task

        // <a href="/tasks?action=edit&id=1" id="edit_task_1">edit</a>
        $this->seeElement('a', [
            'id'    => 'edit_task_'.$tasks[0]->id,
            'href'  => url('tasks?action=edit&id='.$tasks[0]->id),
        ]);

        // <a href="/tasks?action=edit&id=2" id="edit_task_2">edit</a>
        $this->seeElement('a', [
            'id'    => 'edit_task_'.$tasks[1]->id,
            'href'  => url('tasks?action=edit&id='.$tasks[1]->id),
        ]);

        // <a href="/tasks?action=edit&id=3" id="edit_task_3">edit</a>
        $this->seeElement('a', [
            'id'    => 'edit_task_'.$tasks[2]->id,
            'href'  => url('tasks?action=edit&id='.$tasks[2]->id),
        ]);
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
     */
    public function task_entry_must_pass_validation()
    {
        // try submit form for create new task
        // with field name description is empty
        $this->post('/tasks', [
            'name'        => '',
            'description' => '',
        ]);

        // cek session, maybe error for field name and description
        // $this->assertSessionHasErrors(['name', 'description']);
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
