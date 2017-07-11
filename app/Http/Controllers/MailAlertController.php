<?php 
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Team;
use App\Companyteam;
use Auth;
use App\User;
use App\Role;
use DB;
use App\Task;

use Mail;

class MailAlertController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function mailAlert($data, $email)
    {
        $GLOBALS['email'] = $email;
        //$view = view('emails.welcome', $data);
        // print_r($view);
        //echo $GLOBALS['email'];

        Mail::send('emails.welcome', $data, function ($message) {
            //$username = Auth::user()->firstname.Auth::user()->lastname ;
            $message->from( 'applearns@gmail.com', "Laravel Tasks Manage App!!" );

            $message->to($GLOBALS['email']);
            $message->subject("Laravel Tasks Manage App!!");
        });
    }

    public static function mailAlertStatusFromCompany($data)
    {
        //$data = ['name'=>'Company Name', 'status'=>'Status of task'];
        $GLOBALS['email'] = $data['email'];

        Mail::send('emails.status', $data, function ($message) {
            $username = Auth::user()->firstname." ".Auth::user()->lastname ;
            $message->from( 'applearns@gmail.com', $username );

            $message->to($GLOBALS['email']);
            $message->cc(Auth::user()->email, $username );
            $message->subject($username);
        });
    }

    public static function mailAlertStatusFromMember($data)
    {
        
        $GLOBALS['email'] = $data['email'];
        
        //print_r($data);
        Mail::send('emails.status', $data, function ($message) {
            $username = Auth::user()->firstname." ".Auth::user()->lastname ;
            $message->from( 'applearns@gmail.com', $username );

            $message->to($GLOBALS['email']);
            $message->cc(Auth::user()->email, $username );
            $message->subject($username." Task Status!");
        });
    }

}