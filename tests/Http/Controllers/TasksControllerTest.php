<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TasksControllerTest extends TestCase
{
    /**
     * Teste si la page index est accessible
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->action('GET', 'TasksController@index');
        $this->assertResponseOk();
    }

    /**
     * Teste si la page create est accessible
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->action('GET', 'TasksController@create');
        $this->assertResponseOk();
    }

    /**
     * Teste si la creation de tâche fonctionne
     *
     * @return void
     */
    public function testStore()
    {
        $this->visit('/tasks/create');
        $this->type('Example de titre', 'title');
        $this->type('Example de description', 'description');
        $this->press('Create New Task');
        $this->seePageIs('/tasks');
    }

    /**
     * Teste si on peut voir une task en particulier
     * Nécessite une task avec un id de 1
     *
     * @return void
     */
    public function testShow()
    {
        // $task = DB::select('SELECT id FROM tasks WHERE title = :title AND description = :description', ["title"=>"titre_update", "description"=> "description_update"]);
        $response = $this->call('GET', 'tasks/1');
        $this->assertResponseOk();
    }

    /**
     * Teste si la page d'édition d'une tâche fonctionne
     * Nécessite une task avec un id de 1
     *
     * @return void
     */
    public function testEdit()
    {
        $response = $this->call('GET', 'tasks/1/edit');
        $this->assertResponseOk();
    }

    /**
     * Teste si on peut éditer une task
     * Nécessite une task avec un id de 1
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->visit('/tasks/1/edit');
        $this->type('Titre modifié', 'title');
        $this->type('Description modifiée', 'description');
        $this->press('Update Task');
        $this->seePageIs('/tasks');
    }

    /**
     * Teste si on peut supprimer une task
     * Crée une tâche puis la supprime ensuite
     *
     * @return void
     */
    public function testDestroy()
    {
        $this->visit('/tasks/create');
        $this->type('Tâche à supprimer', 'title');
        $this->type('Description de cette tâche', 'description');
        $this->press('Create New Task');

        $task = DB::select('SELECT id FROM tasks WHERE title = :title AND description = :description', ["title"=>"Tâche à supprimer", "description"=> "Description de cette tâche"]);

        $this->visit('/tasks/'. $task[0]->id);
        $this->press('Delete this task?');
        $this->seePageIs('/tasks');
    }    
}