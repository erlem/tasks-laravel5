<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksControllerTest extends TestCase
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->action('GET', 'TasksController@index');
        $this->assertResponseOk();
    }
    public function testStore()
    {
    $this->visit('tasks/create')
         ->type('newTitle', 'title')
         ->type('newDescription', 'description')
         ->press('Create New Task')
         ->seePageIs('/tasks');
        $this->assertRedirectedToRoute('tasks.index');
    
    }
    public function testShow()
    {
       $response = $this->action('GET', 'TasksController@show', ['tasks' => 1]);
        $this->assertResponseOk();
    }
    public function testEdit()
    {
        $response = $this->action('GET', 'TasksController@edit', ['tasks' => 1]);
        $this->assertResponseOk();
    }
    public function testUpdate()
    {
        $this->visit('tasks/1/edit')
         ->type('newTitle', 'title')
         ->type('newDescription', 'description')
         ->press('Update Task')
         ->seePageIs('/tasks');
        $this->assertRedirectedToRoute('tasks.index');
    }
    public function testDestroy()
    {
        $this->visit('tasks')
         ->press('Delete this task?')
         ->seePageIs('/tasks');
        $this->assertRedirectedToRoute('tasks.index');
    }
    
}
