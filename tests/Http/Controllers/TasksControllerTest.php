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


    /**
    *  Teste le bouton de création d'une nouvelle tache
    */
	public function testCreate()
	{
		$this->visit('/')
        ->click('Add New Task')
        ->seePageIs('/tasks/create');	
	}


    /**
    *  Teste les champs du formulaire et le bouton de création d'une nouvelle tache
    */
    public function testStore()
    {
        $this->visit('/tasks/create')
        ->type('Nom à tester','title')  
        ->type('Description à tester','description') 
        ->press('Create New Task')
        ->seePageIs('/tasks');
    }

    /**
    *  Teste le bouton de voir la tache et le bouton de retour à la liste de taches
    */
    public function testShow()
    {
        $this->visit('/tasks')
        ->click('View Task')  
        ->click('Back to all tasks') 
        ->seePageIs('/tasks');
    }

    /**
    *  Teste le bouton qui permet l'edition d'une tache
    */
    public function testEdit()
    {
        $this->visit('/tasks')
        ->click('Edit Task');  
    }

    /**
    *  Teste que les changements dans le formulaire soient  
    *  mis à jour par le bouton "Update Task"
    */
    public function testUpdate()
    {
        $this->visit('/tasks')
        ->click('Edit Task')  
        ->type('Nouveau title à changer','title') 
        ->type('Actualisation  de la nouvelle description','description')
        ->press('Update Task')
        ->seePageIs('/tasks');
    }

    /**
    *  Teste le bouton pour effacer une tache, le message de confirmation 
    *  d'effaçage et le retour à la liste de taches
    */
    public function testDestroy()
    {
        $this->visit('/tasks')
        ->press('Delete this task?')  
        ->seePageIs('/tasks');
    }
}
