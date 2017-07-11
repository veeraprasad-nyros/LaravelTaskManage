<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LinksTest extends TestCase
{
    /**
     * links testing.
     * @test*
     * @return void
     */
    public function links()
    {
        $this->visit('/')
             ->see('Your Application')
        	 ->visit('/register')
        	 ->seePageIs('/register');

        $this->visit('/')
        	 ->visit('/login')
        	 ->seePageIs('/login');

        $this->visit('/')
             ->seePageIs('/');

        $credentials = [
        'email'    => "applearns@gmail.com",
        'password' => "12345678"
        ];

        $this->visit('/')
        	->visit('/home')
        	->seePageIs('/login')
        	->submitForm('Login',  $credentials)
        	->seePageIs('/home')
        	->visit('/logout');

        $this->visit('/')
        	->visit('/login')
        	->submitForm('Login', $credentials)
        	->seePageIs('/')
        	->visit('/logout');       
    }
}
