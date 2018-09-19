<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testLoginLink()
    {
        $this->visit('/')
             ->click('Login')
             ->seePageIs('/login');
    }
    public function testLoginUser()
    {
        $this->visit('/login')
             ->type('candycalico@gmail.com','email')
             ->type('sateayam','password')
             ->press('Login')
             ->seePageIs('/')
             ->dontSee('Administration');
    }
    public function testLoginEditor()
    {
        $this->visit('/login')
             ->type('runrvrun@gmail.com','email')
             ->type('sateayam','password')
             ->press('Login')
             ->seePageIs('/')
             ->see('Administration');
    }
}
