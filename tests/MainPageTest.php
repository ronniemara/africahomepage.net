<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MainPageTest extends TestCase
{
    /**
     *      *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('Mp3AfricaMusic.com');
    }
}
