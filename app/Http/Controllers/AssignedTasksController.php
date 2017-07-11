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

class AssignedTasksController extends Controller
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

    public function viewTasks()
    {
         $tasks = DB::table('tasks')
                ->join('users', 'users.id', '=', 'tasks.muser_id')
                ->join('members', 'members.muser_id', '=', 'users.id')
                ->join('teams','teams.id', '=', 'members.team_id')
                ->where('members.muser_id', '=', Auth::user()->id)
                ->select('tasks.id as task_id','tasks.name as task_name', 'teams.name as team_name', 'users.lastname as member_name', 'tasks.muser_id', 'tasks.cuser_id', 'tasks.tstatus', 'tasks.description', 'tasks.created_at')
                ->orderBy('tasks.created_at','desc')
                ->get();

        // echo "<pre>";
        // print_r($tasks);
        // echo "</pre>";

    	return view("assignedtaskstomember", ['tasks'=>$tasks]);
    }

    public function statusChangeTask(Request $request, $task_id)
    {
        DB::table('tasks')
            ->where('id', $task_id)
            ->update(['tstatus' => $request->tstatus]);

        $taskdetails = DB::table('tasks')
            ->where('id', '=', $task_id)
            ->first();

        $cuseremail = DB::table('users')
                    ->where('users.id', '=', $taskdetails->cuser_id)
                    ->select('users.email')
                    ->first();
        $data = [
                 'name'        => $taskdetails->name, 
                 'description' => $taskdetails->description,
                 'tstatus'     => $taskdetails->tstatus,
                 'email'       => $cuseremail->email
                ];

        MailAlertController::mailAlertStatusFromMember($data);
                
        return response()->json($request);
    }

}