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
	//Test de la fonction Create
	public function testCreate()
    {
	$this->visit('/')
         ->click('Add New Task')
         ->seePageIs('/tasks/create');
    }
	// Test de la fonction store
	public function testStore()
    {
	$this->visit('/tasks/create')
         ->type('TitreTest', 'title')
	->type('DescriptionTest', 'description')
         ->press('Create New Task')
         ->seePageIs('/tasks')
	->see('Task successfully added!');
    }
	//Test de la fonction destroy
	public function testDestroy()
    {
	$this->visit('/tasks')
	->press('Delete this task?')
	->seePageIs('/tasks')
	->see('Task successfully deleted!');
    }
	//Test de la fonction show
	public function testShow()

    {
	$this->visit('/tasks')
	->click('View Task')
	->seePageIs('/tasks/1');
	
    }
	//Test de la fonction edit
	public function testEdit()

    {
	$this->visit('/tasks')
	->click('Edit Task')
	->seePageIs('/tasks/1/edit');
	
    }
	
	public function testUpdate()
    {
	$this->visit('/tasks/1/edit')
         ->type('titreTestUpdate', 'title')
	->type('DescriptionTestUpdate', 'description')
         ->press('Update Task')
         ->seePageIs('/tasks')
	->see('Task successfully modified!');
    }


}
