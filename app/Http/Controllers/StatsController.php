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

class StatsController extends Controller
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

    public function getCompanyStats(Request $request)
    {
    	//total teams 
    	$tcount = DB::table('companyteams')
    				->where('companyteams.cuser_id', '=', Auth::user()->id)
    				->count();
    	//total teams members
    	$tmcount = DB::table('members')
    				->where('members.cuser_id', '=', Auth::user()->id)
    				->count();
		//total tasks     	
    	$tscount = DB::table('tasks')
    			    ->where('tasks.cuser_id', '=', Auth::user()->id)
    				->count();

    	return response()->json(['tcount'=>$tcount, 'tmcount'=>$tmcount, 'tscount'=>$tscount]);
    }

    public function getDashboard()
    {
    	return view('companydashboard');
    }
}