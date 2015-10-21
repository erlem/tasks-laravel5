<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageControllerTest extends TestCase
{
    public function testHome()
    {
        $response = $this->action('GET', 'PagesController@home');
        $this->assertResponseOk();
    }
}