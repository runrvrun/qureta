<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LombaTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */

   public function testOpenLombaAndLogin()
   {
       $this->visit('/lomba-esai')
            ->click('Kirim Tulisan')
            ->seePageIs('/login')
            ->type('candycalico@gmail.com','email')
            ->type('sateayam','password')
            ->press('Login')
            ->seePageIs('/kirim-tulisan/lomba/12');
   }
}
