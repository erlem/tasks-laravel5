<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageHomeTest extends TestCase
{
    /**
     * A basic functional test page.
     *
     * @return void
     */
    public function testPage()
    {
        $this->visit('/')
            ->see('Home')
            ->see('Tasks')
            ->see('Welcome');
    }

    /**
     * A basic functional test button View Tasks.
     *
     * @return void
     */
    public function testClickViewTasks()
    {
        $this->visit('/')
            ->click('View Tasks')
            ->seePageIs('/tasks');
    }

    /**
     * A basic functional test button Add New Task.
     *
     * @return void
     */
    public function testAddNewTask()
    {
        $this->visit('/')
            ->click('Add New Task')
            ->seePageIs('/tasks/create');
    }
}
