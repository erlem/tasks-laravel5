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

    /*
     * Create new task
     * @return void
     */
    public function testCreate(){
      $this->visit('/')
      ->click('Add New Task')
      ->seePageIs('/tasks/create');
    }

    /**
     * Update task (edit button)
     * @return void
     */
    public function testUpdate(){
      $this->visit('/tasks/1/edit')
      ->type('New title', 'title')
      ->type('New Desc', 'description')
      ->press('Update Task')
      ->seePageIs('/tasks');
    }

    /**
     * Delete task ans back to listing
     * @return void
     */
    public function testDestroy(){
      $this->visit('tasks/1')
      ->press('Delete this task?')
      ->seePageIs('/tasks');
    }

    /**
    * Show task and back listing
    * @return void
    */
    public function testShow(){
      $this->visit('/tasks')
      ->click('View Task')
      ->click('Back to all tasks')
      ->seePageIs('/tasks');
    }
}
