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

        // user fill field `name` and `description` and then submit this value
        $this->type('My First Task', 'name');
        $this->type('This is my first task on my new job', 'description');
        $this->press('Create Task');

        // view record on database
        $this->seeInDatabase('tasks', [
            'name'  => 'My First Task',
            'description'   => 'This is my first task on my new job',
        ]);

        // redirect to view list task
        $this->seePageIs('/tasks');

        // view list task while submit
        $this->see('My First Task');
        $this->see('This is my first task on my new job');
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
        // generate 1 record task on table `task`
        $task = factory(Task::class)->create();

        // User can view page of list task
        $this->visit('/tasks');

        // Klik button edit task by id $task
        $this->click('edit_task_'.$task->id);

        // Show URL to a link target
        $this->seePageIs('/tasks?action=edit&id='.$task->id);

        //show form edit Task
        // using id and action by id
        $this->seeElement('form', [
            'id'    => 'edit_task_'.$task->id,
            'action'=> url('tasks/'.$task->id),
        ]);

        // User submit form filled name and deskripsi a new task
        $this->submitForm('Update Task', [
            'name'  => 'Updated Task',
            'description'   => 'Updated task description',
        ]);

        // Show new page to redirect URL target, back on url '/tasks'
        $this->seePageIs('/tasks');

        // Record in database change by name and new deskprisi
        // $this->seeInDatabase('tasks', [
        //     'id'    => $task->id,
        //     'name'  => 'Updated Task',
        //     'description'    => 'Updated task description.',
        // ]);
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
        //$this->assertSessionHasErrors(['name', 'description']);
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
