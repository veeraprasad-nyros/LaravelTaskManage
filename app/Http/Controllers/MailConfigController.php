<?php

	namespace App\Http\Controllers;

	use App\Http\Requests;
	use Illuminate\Http\Request;

	use \Swift_Mailer;
	use \Swift_SmtpTransport as SmtpTransport;
	use Mail;

	class MailConfigController extends Controller
	{
		public $smtp = 'smtp.gmail.com';
		public $port = 587;
		public $encription = 'tls';

		public function __construct()
	    {
	        
	    }

	    public function mailCofig($smtp, $port, $encription)
	    {
	    	$this->smtp       = $smtp;
	    	$this->port       = $port;
	    	$this->encription = $encription;
	    }

	    public function mailSendGeneral($smtp, $port, $encription, $username, $secure, $to,$data )
	    {
	    	$transport = SmtpTransport::newInstance($smtp, $port, $encription);
	    	$transport->setUsername($username);
			$transport->setPassword($secure);
			$generalmail = new Swift_Mailer($transport);
			Mail::setSwiftMailer($generalmail);

			$GLOBALS['to'] = $to;
			$GLOBALS['username'] = $username;

			Mail::send("emails.status", $data, function($message) {
         		$message->to( $GLOBALS['to'], 'Learning sending emails from particular email account' )
         				->subject( 'Laravel Basic Testing Mail' );
         		$message->from( $GLOBALS['username'],'Veera Prasad' );
      		});
	    }

	    public function testGeneral(){
	    	$data = array('name'=>"Veera Prasad" ,'tstatus'=>"Checking Email", 'description'=>"Learning sending emails from particular email account");

	    	//$this->mailSendGeneral('smtp.gmail.com', 465, 'ssl','applearns@gmail.com','pr@s@d1989','applearns@outlook.com',$data);

	    	//$this->mailSendGeneral('smtp.gmail.com', 587, 'tls','applearns@gmail.com','pr@s@d1989','applearns@outlook.com',$data);

	    	//$this->mailSendGeneral('smtp.mail.yahoo.com', 587, 'tls','applearns@yahoo.com','pr@s@d1989','applearns@outlook.com',$data);

	    	//$this->mailSendGeneral('smtp.live.com', 587, 'tls','applearns@outlook.com','pr@s@d1989','applearns@outlook.com',$data);

	    }


	    public function gmail()
	    {
	    	$transport = SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl');

			$transport->setUsername('veeraprasadsmart@gmail.com');
			$transport->setPassword('pr@s@d1989');
			$gmail = new Swift_Mailer($transport);
			Mail::setSwiftMailer($gmail);

			$data = array('name'=>"Veera Prasad" ,'tstatus'=>"Checking Email", 'description'=>"Learning sending emails from particular email account");
   
      		Mail::send("emails.status", $data, function($message) {
         		$message->to('applearns@outlook.com', 'Learning sending emails from particular email account')
         				->subject('Laravel Basic Testing Mail');
         		$message->from('veeraprasadsmart@gmail.com','Veera Prasad');
      		});

	    	//print_r($gmail);
	    }

	    public function yahoo()
	    {
	    	$transport = SmtpTransport::newInstance('smtp.mail.yahoo.com', 587, 'tls');
			$transport->setUsername('applearns@yahoo.com');
			$transport->setPassword('pr@s@d1989');
			$gmail = new Swift_Mailer($transport);
			Mail::setSwiftMailer($gmail);

			$data = array('name'=>"Veera Prasad" ,'tstatus'=>"Checking Email", 'description'=>"Learning sending emails from particular email account");
   
      		Mail::send("emails.status", $data, function($message) {
         		$message->to('applearns@gmail.com', 'Learning sending emails from particular yahoo email account')
         				->subject('Laravel Basic Testing Mail');
         		$message->from('applearns@yahoo.com','Veera Prasad');
      		});

	    	//print_r($gmail);
	    }

	    public function hotmail()
	    {
	    	$transport = SmtpTransport::newInstance('smtp.live.com', 587, 'tls');
			$transport->setUsername('applearns@outlook.com');
			$transport->setPassword('pr@s@d1989');
			$gmail = new Swift_Mailer($transport);
			Mail::setSwiftMailer($gmail);

			$data = array('name'=>"Veera Prasad" ,'tstatus'=>"Checking Email", 'description'=>"Learning sending emails from particular email account");
   
      		Mail::send("emails.status", $data, function($message) {
         		$message->to('applearns@gmail.com', 'Learning sending emails from particular outlook hotmail email account')
         				->subject('Laravel Basic Testing Mail');
         		$message->from('applearns@outlook.com','Veera Prasad');
      		});

	    	//print_r($gmail);
	    }



	    public function sample()
	    {

      		$data = array('name'=>"Veera Prasad" ,'tstatus'=>"Checking Email", 'description'=>"Learning sending emails from particular email account");
   
      		Mail::send("emails.status", $data, function($message) {
         		$message->to('applearns@yahoo.com', 'Learning sending emails from particular email account')
         				->subject('Laravel Basic Testing Mail');
         		//$message->from('xyz@gmail.com','Virat Gandhi');
      		});
	    }
	}