<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Task;

class TasksControllerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->tasks = Task::all();
    }

    public function testIndex()
    {
        $this->action('GET', 'TasksController@index'); //envoie une requête GET à la méthode index du TasksController
        $this->assertResponseOk();  //verifie que le code de la requête est 200
        $this->assertEquals(Request::url(), 'http://localhost/tasks'); //vérifie que le lien est bien égale à http://localhost/tasks
    }

    public function testCreate()
    {
        $this->action('GET', 'TasksController@create');
        $this->assertResponseOk();
        $this->assertEquals(Request::url(), 'http://localhost/tasks/create');
    }

    public function testValidStore()
    {
        //initialisation d'un tableau contenant un titre et une description générés aléatoirement pour les test d'insertion
        $insert = [
            'title'         =>  $this->randString(),
            'description'   =>  $this->randString()
        ];

        //verifie que le titre et la description ne sont pas présent en BDD
        $this->assertEquals(Task::where($insert)->count(), 0); 

        //insertion du titre et de la description en BDD
        $this->visit('/tasks/create')
             ->type($insert['title'], 'title')
             ->type($insert['description'], 'description')
             ->press('Create New Task')
             ->seePageIs('/tasks'); //vérifie que la redirection a bien lieu

        //verifie que l'enregistrement c'est bien effectué
        $this->assertEquals(Task::where($insert)->count(), 1);

        //recuperation de l'id du nouvel enregistrement
        $id = DB::getPdo()->lastInsertId();

        //recupération des nouveaux attributs de l'enregistrement grâce à son id
        $attributes = Task::find($id);

        //vérification que le titre et la description correspondent à ceux défini précédemment
        $this->assertEquals($attributes['title'], $insert['title']);
        $this->assertEquals($attributes['description'], $insert['description']);
    }

    public function testFailTitleStore()
    {
        $description = $this->randString();

        //veification qu'il n'y a pas d'enregistrement contenant la description définie précédemment
        $this->assertEquals(Task::where('description', '=', $description)->count(), 0);

        //verifie que le titre est bien obligatoire
        $this->visit('/tasks/create')
             ->type('', 'title')
             ->type($description, 'description')
             ->press('Create New Task')
             ->seePageIs('/tasks/create'); //vérifie que l'on reste sur la même page

        //vérification que la description ne s'est pas enregistrée
        $this->assertEquals(Task::where('description', '=', $description)->count(), 0);
    }

    public function testFailDescriptionStore()
    {
        $titre = $this->randString();

        //veification qu'il n'y a pas d'enregistrement contenant la description définie précédemment
        $this->assertEquals(Task::where('title', '=', $titre)->count(), 0);

        //verifie que la description est bien obligatoire
        $this->visit('/tasks/create')
             ->type($titre, 'title')
             ->type('', 'description')
             ->press('Create New Task')
             ->seePageIs('/tasks/create'); //vérifie que l'on reste sur la même page

        //véridfication que le titre ne s'est pas enregistré
        $this->assertEquals(Task::where('title', '=', $titre)->count(), 0);
    }

    public function testShow()
    {   
        //récupere toutes les taches en BDD
        //$tasks = Task::all();
        //vérifie que le code de la reponse est bien 200 pour chaque id
        foreach ($this->tasks as $task) {
            $attributes = $task->getAttributes();
            $this->call('GET', 'tasks/' . $attributes['id']);
            $this->assertResponseOk();
        }
        
    }

    public function testFailShow()
    {
        //vérifie que l'on est bien redirigé vers la page 'local.tasks/tasks' 
        //lorsque l'on écrit une chaine de caractère dans l'url
        $this->call('GET', 'tasks/1a');
        $this->assertRedirectedToRoute('tasks.index');
    }

    public function testNotFoundIdShow()
    {
        //vérifie que l'on est bien redirigé vers la page 'local.tasks/tasks' 
        //lorsque l'on écrit un id qui n'existe pas dans la BDD
        $this->call('GET', 'tasks/999999');
        $this->assertRedirectedToRoute('tasks.index');
    }

    public function testEdit()
    {
        //récupere toutes les taches en BDD
        //$tasks = Task::all();
        //vérifie que le code de la reponse est bien 200 pour chaque id
        foreach ($this->tasks as $task) {
            $attributes = $task->getAttributes();
            $this->call('GET', 'tasks/' . $attributes['id'] . '/edit');
            $this->assertResponseOk();
        }
    }

    public function testFailEdit()
    {
        $this->call('GET', 'tasks/1b/edit');
        $this->assertRedirectedToRoute('tasks.index');
    }

    public function testNotFoundIdEdit()
    {
        $this->call('GET', 'tasks/999999/edit');
        $this->assertRedirectedToRoute('tasks.index');
    }

    public function testUpdate()
    {
        //initialisation d'un tableau contenant un titre et une description générés aléatoirement pour les test d'insertion et de modification
        $insert = [
            'title'         =>  $this->randString(),
            'description'   =>  $this->randString()
        ];

        //insertion du nouvel enregistrement en BDD
        $this->visit('/tasks/create')
             ->type($insert['title'], 'title')
             ->type($insert['description'], 'description')
             ->press('Create New Task')
             ->seePageIs('/tasks');

        //recuperation de l'id du nouvel enregistrement
        $id = DB::getPdo()->lastInsertId();

        //definition d'un nouveau titre et d'une nouvelle description pour la mise à jour
        $newTitle = $this->randString();
        $newDescription = $this->randString();

        //mise à jour de l'enregistrement
        $this->visit('/tasks/' . $id . '/edit')
             ->type($newTitle, 'title')
             ->type($newDescription, 'description')
             ->press('Update Task')
             ->seePageIs('/tasks');

        //recupération des nouveaux attributs de l'enregistrement grâce à son id
        $newAttributes = Task::find($id);

        //vérification que le titre et la description correspondent à ceux défini précédemment
        $this->assertEquals($newAttributes['title'], $newTitle);
        $this->assertEquals($newAttributes['description'], $newDescription);
    }

    public function testDestroy()
    {
        //initialisation d'un tableau contenant un titre et une description générés aléatoirement pour les test d'insertion
        $insert = [
            'title'         =>  $this->randString(),
            'description'   =>  $this->randString()
        ];

        //insertion du titre et de la description en BDD
        $this->visit('/tasks/create')
             ->type($insert['title'], 'title')
             ->type($insert['description'], 'description')
             ->press('Create New Task')
             ->seePageIs('/tasks');

        $id = DB::getPdo()->lastInsertId();

        //suppression de l'enregistrement
        $this->visit('/tasks/'. $id)
             ->press('Delete this task?')
             ->seePageIs('/tasks');

        //vérification que l'enregistrement n'existe plus en BDD
        $this->assertEquals(Task::find($id), null);

    }

    public function randString($length = 10)
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }
}