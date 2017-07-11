<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{ 
    /**
     * @return void
     * @test*
     * @dataProvider LoginChoice
     */
    public function myLogin($user, $pwd)
    {
        $credentials = [
        'email'    => $user,
        'password' => $pwd
        ];
        $this->visit('/login')
                ->submitForm('Login',  $credentials)
                ->visit('/home')
                ->see('Welcome')
                ->visit('/logout');  
    }
    /**
     * @return array
     */
    public function LoginChoice()
    {
        return array(
            'applearns' => array("applearns@gmail.com", "12345678"),
            'veera'     => array("satyajan999@gmail.com","123456"),
            //'Null'      => array(null,null),
            //'Empty'     => array("",""),
        );
    }
}
