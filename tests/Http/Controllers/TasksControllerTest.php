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
	$this->visit('/') //on ouvre la page d'accueil
         ->click('Add New Task') //on clique sur le lien pour ajouter une nouvelle task
         ->seePageIs('/tasks/create'); //on vérifie que la page formulaire est bien ouverte
    }
	// Test de la fonction store
	public function testStore()
    {
	$this->visit('/tasks/create') //on ouvre la page formulaire pour ajouter une nouvelle task
         ->type('titre', 'title') //on remplit le champs 'title'
	->type('description test', 'description') //on remplit le champs 'description'
         ->press('Create New Task') //on valide le formulaire
         ->seePageIs('/tasks') //on vérifie qu'après la validation on retourne à la page de la liste des tasks
	->see('Task successfully added!'); //on vérifie si le message 'Task successfully added!' s'affiche sur la page
    }
	//Test de la fonction destroy
	public function testDestroy()
    {
	$this->visit('/tasks') //on ouvre la page liste des tasks
	->press('Delete this task?') //on clique sur le premier lien pour supprimer une task
	->seePageIs('/tasks') //on vérifie qu'après la suppression on retourne à la page de la liste des tasks
	->see('Task successfully deleted!'); //on vérifie si le message 'Task successfully deleted!' s'affiche sur la page
    }
	//Test de la fonction show
	public function testShow()

    {
	$this->visit('/tasks') //on ouvre la page liste des tasks
	->click('View Task') //on clique sur le premier lien  pour voir une task
	->seePageIs('/tasks/1'); //on verifie qu'on ouvre bien la task numéro 1
	
    }
	//Test de la fonction edit
	public function testEdit()

    {
	$this->visit('/tasks') //on ouvre la page liste des tasks
	->click('Edit Task') //on clique sur le premier lien  pour étider une task
	->seePageIs('/tasks/1/edit'); //on verifie qu'on ouvre bien la page pour éditer task numéro 1
	
    }
	//Test de la fonction update
	public function testUpdate()
    {
	$this->visit('/tasks/1/edit') //on va sur la page pour éditer la task numéro 1
         ->type('titre', 'title') //on modifie le champs 'title'
	->type('description test update', 'description') //on modifie le champs 'description'
         ->press('Update Task') //on valide le formulaire
         ->seePageIs('/tasks') //on vérifie qu'après la modification on retourne à la page de la liste des tasks
	->see('Task successfully modified!'); //on vérifie si le message 'Task successfully modified!' s'affiche sur la page
    }


}
