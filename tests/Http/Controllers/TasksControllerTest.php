<?php

/*
Documentation :
- Laravel testing : http://laravel.com/docs/5.1/testing
- Mémento function: http://cheats.jesse-obrien.ca/
- Api : http://laravel.com/api/5.1/index.html
*/

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksControllerTest extends TestCase
{   
    public function testIndex()
    {
        // Action d'envoie vers l'index
        $response = $this->action('GET', 'TasksController@index');
        // Vérification de la réponse
        $this->assertResponseOk();
    }

    public function testCreate()
    {
        // Action d'envoie vers l'index
        $response = $this->action('GET', 'TasksController@create');
        // Vérification de la réponse
        $this->assertResponseOk();
    }

    public function testStore()
    {
        // Accès à la page de création de tache
        $this->visit('/tasks/create')
             // Ajout du titre dans le formulaire
             ->type('titre_test', 'title')
             // Ajout de la description dans le formulaire
             ->type('titre_description', 'description')
             // Click sur le bouton de création
             ->press('Create New Task')
             // Redirection vers la page des taches
             ->seePageIs('/tasks');
    }

    public function testShow()
    {   
        // Action d'envoie vers la tache numéro 1
        $response = $this->call('GET', 'tasks/1');
        // vérification de la réponse
        $this->assertResponseOk();
    }

    public function testEdit()
    {
        // Action d'envoie vers l'édition de la tache numéro 1
        $response = $this->call('GET', 'tasks/1/edit');
        // Vérification de la réponse
        $this->assertResponseOk();
    }    

    public function testUpdate()
    {
        // Création d'un objet tache pour modification
        $this->visit('/tasks/create')
             ->type('titre_update', 'title')
             ->type('description_update', 'description')
             ->press('Create New Task')
             ->seePageIs('/tasks');

        // Requete préparée pour récupérer l'id de l'objet créé
        $task = DB::select('SELECT id 
                            FROM tasks 
                            WHERE title = :title 
                            AND description = :description', 
                            ["title"=>"titre_update", "description"=> "description_update"]);

        // Accès à la page d'édition de la tache numéro 1
        $this->visit('/tasks/'. $task[0]->id .'/edit')
        // Ajout du titre dans le formulaire
             ->type('Titre de la tache update', 'title')
         // Ajout de la description de la description
             ->type('Description de la tache update', 'description')
         // click sur le bouton 'Update Task'
             ->press('Update Task')
         // Redirection vers la page des taches
             ->seePageIs('/tasks');
    }

    public function testDestroy()
    {
        // Création d'un objet tache à supprimer
        $this->visit('/tasks/create')
             ->type('titre_suppression', 'title')
             ->type('description_suppression', 'description')
             ->press('Create New Task')
             ->seePageIs('/tasks');

        // Requete préparée pour récupérer l'id de l'objet créé
        $task = DB::select('SELECT id 
                            FROM tasks 
                            WHERE title = :title 
                            AND description = :description', 
                            ["title"=>"titre_suppression", "description"=> "description_suppression"]);

        // Accès à la page de la tache numéro à supprimer
        $this->visit('/tasks/'. $task[0]->id)
         // click sur le bouton 'Update Task'
             ->press('Delete this task?')
         // Redirection vers la page des taches
             ->seePageIs('/tasks');
    }    
}
