<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksControllerTest extends TestCase
{
    
    // Methode testIndex
    public function testIndex(){
        $response = $this->action('GET', 'TasksController@index');
        // On vérifie la réponse
        $this->assertResponseOk();
    }
    
    // Methode testCreate 
    public function testCreate(){
        $response = $this->action('GET', 'TasksController@create');
        // On vérifie la réponse
        $this->assertResponseOK();
    }
    
    // Methode testStore
    public function testStore(){
        $this->visit('tasks/create') // On accède à la page de création de tâches
        ->type('monTitre', 'title') // Modification du champ titre
        ->type('maDescription', 'description') // Modification du champ description
        ->press('Create New Task') // On click sur le bouton
        ->seePageIs('/tasks'); // On redirige vers la page d'affichage des tâches
    }
    
    // Methode testShow
    public function testShow(){
        // On renvoi vers la tâche N°1 
        $response = $this->call('GET', 'tasks/1');  
        // On vérifie la réponse
        $this->assertResponseOk();
    }
    
    // Methode testEdit
    public function testEdit(){
       // On renvoi vers la page d'édition de la tâche N°1
       $response = $this->call('GET', 'tasks/1/edit');
       // On vérifie la réponse
       $this->assertResponse();
    }
    
    // Methode testUpdate
    public function testUpdate(){
        // On part du principe qu'une tâche est déjà crée
        // On va sur la page d'édition de la tâche N°1
        $this->visit('/tasks/1/edit') // On accède à la page d'édition de la tâche N°1
        ->type('nouveauTitre', 'title') // Modification du champ titre
        ->type('nouvelleDescription', 'description') // Modification du champ description
        ->presse('Update Task') // On click sur le bouton
        ->seePageIs('tasks'); // On redirige vers la page d'affichage des tâches
    }
    
    // Methode testDestroy
    public function testDestroy(){
        $this->visit('tasks/1') // On accède à la page d'édition de la tâche N°1
        ->press('Delete this task?') // On click sur le bouton
        ->seePageIs('/tasks'); // On redirige vers la page d'affichage des tâches
    }
}
