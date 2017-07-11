<?php

	class RegisterTest extends TestCase
	{
		/**
		 * @return void
		 * @test*
		 */
		public function register()
		{
			/*
			$newUser = [
	         
	        	'firstname' => 'T',
	        	'lastname'  => 'T',
	        	'email'     => 'veeraprasad_nyros@yahoo.com',
	        	'password'  => '12345678',
	        	'password_confirmation' => '12345678',
	        	'address'   => 'Kakinada'
	        ]; 
	        $this->visit('/')
	            ->visit('/register')
	            ->seePageIs('/register')
	            ->submitForm('Register', $newUser)
	            ->seePageIs('/')
	            ->visit('/logout');
			*/
		}

		/**
		 * @return void
		 * @test*
		 * @dataProvider registerDataProvider
		 */

		public function registerWithDataProvider($firstname,$lastname,$email,$password,$pswdcon,$addr)
		{
	        $newUser = [
	           
	        	'firstname' => $firstname,
	        	'lastname'  => $lastname,
	        	'email'     => $email,
	        	'password'  => $password,
	        	'password_confirmation' => $pswdcon,
	        	'address'   => $addr
	        ]; 
	        $this->visit('/')
	            ->visit('/register')
	            ->seePageIs('/register')
	            ->submitForm('Register', $newUser)
	            ->seePageIs('/register');
		}

		public function registerDataProvider()
		{
			return array(
				'Null' => array(null,null,null,null,null,null),
				'empty'=> array( "", "", "", "", "", "" ),
				'exitedEmail'=> array('c','c','applearns@gmail.com','12345678','12345678','kkd'),
				'Password Not confirm'=> array('c','c','applearnss@gmail.com','12345678','1234567888','kkd'),
			);
		}
	}