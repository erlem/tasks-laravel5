<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksControllerTest extends TestCase
{
    /**
     * Display a listing of the resource.
     *
     * But de la fonction :
     * verifier qu'il est
     * bien aller sur l'index.
     *
     * @return void
     */
    public function testIndex()
    {
        //J'appelle la page d'index
        $response = $this->action('GET', 'TasksController@index');
        //Vérifie s'il est bien arrivé sur la page
        $this->assertResponseOk();
    }


    /**
     * But de la fonction :
     * verifier qu'il va bien
     * sur la page de création
     */
    public function testCreate()
    {
        //aller sur la page index
        $this->visit('/')
            //click sur le bouton Add new tasks
            ->click('Add New Task')
            //Vérification si la page est la bonne
            ->seePageIs('/tasks/create');
    }


    /**
     * But de la fonction :
     * test la création d'une tache et
     * l'enregistre dans la base de
     * données puis se affiche l'index
     */
    public function testStore()
    {
        //aller sur la page de création
        $this->visit('/tasks/create')
            //on remplit le champ 'title' du formulaire
            ->type('Ma valeur titre', 'title')
            //on remplit le champ 'description' du formulaire
            ->type('Ma valeur de description', 'description')
            //On clique (/!\ PRESS pour un formulaire) sur le bouton 'Create New Task'
            ->press('Create New Task')
            //Vérification si la page est la bonne
            ->seePageIs('/tasks');
    }


    /**
     * But de la fonction :
     * test l'affichage la tache
     * un peu comme une fiche détaillée
     */
    public function testShow()
    {
        //On appelle la page de la task n°1 :
        $response = $this->call('GET', 'tasks/1');
        //Vérifie s'il arrive a aller à la page
        $this->assertResponseOk();
    }


    /**
     * But de la fonction :
     * test l'affichage de la page pour
     * la modification d'une tache
     */
    public function testEdit()
    {
        //On appelle la page /task/1/edit
        $response = $this->call('GET', 'tasks/1/edit');
        //Vérifie s'il arrive bien sur la page
        $this->assertResponseOk();
    }


    /**
     * But de la fonction :
     * teste la modification de données d'une taches et
     * les enregistrent dans la bdd
     */
    public function testUpdate()
    {
        //on va sur la page d'édition
        $this->visit('/tasks/1/edit')
            //on modifie les champs
            ->type('Mon nouveau titre', 'title')
            ->type('Ma nouvelle description', 'description')
            //on press le bouton 'Update Task'
            ->press('Update Task')
            //On vérifie qu'il nous redirige bien vers l'index
            ->seePageIs('/tasks');
    }

    /**
     * But de la fonction :
     * teste la suppression d'une tache de la base de données
     * et affiche l'index
     */
    public function testDestroy()
    {
        //On appelle la page de destroy
        //Il faudra changer le paramètre (6 actuellement) à chaque PHPUNIT!!!!
        $this->visit('tasks/8')
            //on press le bouton
            ->press('Delete this task?')
            //on verifie s'il nous redirige bien vers l'index
            ->seePageIs('/tasks');
    }
}