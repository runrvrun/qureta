<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testHomeJsCss()
    {
        $this->visit('/')
             ->see('Qureta')
             ->see('qureta.js')
             ->see('style.css');
    }
    public function testHeader()
    {
        $this->visit('/')
             ->see('Artikel')
             ->see('Penulis')
             ->see('Buqu')
             ->see('Topik')
             ->see('Tulis Artikel')
             ;
    }
}
