<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use App\Team;
use App\Companyteam;
use App\Member;
use Auth;
use App\User;
use App\Role;
use DB;
use App\Task;

use App\Http\Controllers\MailAlertController;

class CompanyController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    // public function getTeam()
    // {
    //     return view('addteam');
    // }
    public function teamExist(Request $request, $name)
    {
        $count = DB::table('teams')
                ->join('companyteams', 'teams.id', '=', 'companyteams.team_id')
                ->where('companyteams.cuser_id', '=', Auth::user()->id)
                ->where('teams.name', '=', strtoupper($request->name))
                ->count();

        if($count) 
        {
            //team existed
            return response()->json(["status" => 1]);
        }
        else
        {
            return response()->json(["status" => 0]);
        }
    }
    public function addTeam(Request $request)
    {
             
            $getIdExisTeamName = DB::table('teams')
                                ->select('id')
                                ->where('name', '=', $request->name)
                                ->get();
                       
            if(count($getIdExisTeamName) == 0)
            {
                $newteam = new Team();
                $newteam->name = strtoupper($request->name);
                $newteam->save();

                $cteam = new Companyteam();
                $cteam->cuser_id = Auth::user()->id;
                $cteam->team_id  = $newteam->id;
                $cteam->save();

            }
            else if(count($getIdExisTeamName) == 1)
            {
               
                $cteam = new Companyteam();
                $cteam->cuser_id = Auth::user()->id;
                $cteam->team_id  = $getIdExisTeamName[0]->id;
                $cteam->save();
            }
        $getIdExisTeamName = DB::table('teams')
                        ->select('id')
                        ->where('name', '=', $request->name)
                        ->get();

        $teamsdetails = DB::table('teams')
                ->join('companyteams', 'teams.id', '=', 'companyteams.team_id')
                ->where('cuser_id', '=', Auth::user()->id)
                ->where('teams.id', '=', $getIdExisTeamName[0]->id)
                ->select('teams.name as team_name', 'companyteams.cuser_id' ,'teams.created_at','teams.updated_at')
                ->get();  

        return response()->json( $teamsdetails);

    }

    public function viewTeam()
    {
        $teamsdetails = DB::table('teams')
                ->join('companyteams', 'teams.id', '=', 'companyteams.team_id')
                ->where('cuser_id', '=', Auth::user()->id)
                ->select('teams.name as team_name', 'companyteams.cuser_id' ,'teams.created_at','teams.updated_at')
                ->get();

        // echo "<pre>";
        // print_r($teamsdetails);
        // echo "</pre>";

        return view('viewteam', ['teamsdetails'=>$teamsdetails]);
    }
    public function teamInfo()
    {

        $teams = DB::table('teams')
                ->join('companyteams', 'teams.id', '=', 'companyteams.team_id')
                ->where('cuser_id', '=', Auth::user()->id)
                ->select('teams.id','teams.name as team_name')
                ->get();

        $teamsmembers = DB::table('teams')
                ->join('members', 'teams.id', '=', 'members.team_id')
                ->select('teams.id','teams.name as team_name')
                ->get();
     
        for($i = 0; $i < count($teams); $i++)
        {
            $count = 0;
            for($j = 0; $j < count($teamsmembers); $j++)
            {
                if($teams[$i]->id == $teamsmembers[$j]->id)
                    $count++;
            }
            $teams[$i]->mtot = $count;
        }
   
        return response()->json($teams);
    }
    
    public function getMember()
    {
        $teams = DB::table('teams')
                ->join('companyteams', 'teams.id', '=', 'companyteams.team_id')
                ->where('cuser_id', '=', Auth::user()->id)
                ->select('teams.id','teams.name as team_name')
                ->get();

        return view('addmember', ['teams'=>$teams] );
    }
   
    public function emailvalidate(Request $request, $email)
    {
        $count = DB::table('users')
                ->where('email', '=', $email)
                ->count();
       // echo $count;

        if($count) 
        {
            return response()->json(["status" => 0]);
        }
        else
        {
            return response()->json(["status" => 1]);
        }
        //return response()->json($request->email);
    }

    public function addMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email'     => 'required|max:255|unique:users',
            'password'  => 'required|min:6|confirmed',
            'address'   => 'max:255',
            'teamid'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/company/member/')
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {   
            $role_id = Role::select('id')->where('name', '=', 'member')->first();
            $muser = new User();
            $muser->firstname = $request->firstname;
            $muser->lastname  = $request->lastname;
            $muser->email     = $request->email;
            $muser->role_id   = $role_id->id;
            $muser->password  = bcrypt($request->password);
            $muser->address   = $request->address;
            $muser->save();

            // $member = new Member();
            // $member->cuser_id  = Auth::user()->id;
            // $member->team_id   = $request->teamid;
            // $member->muser_id  = $muser->id;
            DB::table('members')->insert(
                ['cuser_id' =>  Auth::user()->id,'team_id' => $request->teamid, 'muser_id'=> $muser->id]
            );
            // dump($muser);
            // dump($member);
            return redirect('/company/member/view');
        }
       
        
    }
    ////////////////////////////////
    public function newMember(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";
        $role_id = Role::select('id')->where('name', '=', 'member')->first();
        $member = new User();
        $member->firstname = $request->firstname;
        $member->lastname  = $request->lastname;
        $member->email     = $request->email;
        $member->role_id   = $role_id->id;
        //$member->team_id   = $request->teamid;
        $member->password  = bcrypt($request->password);
        $member->address   = $request->address;
        $member->save();

        DB::table('members')->insert(
                ['cuser_id' =>  Auth::user()->id,'team_id' => $request->teamid, 'muser_id'=> $member->id]
        );

        //alert()->success('Member added successful');
        //echo "Member added successful";
        //return redirect('/company/task');
        // $teams = DB::table('teams')
        //         ->join('members', 'teams.id', '=', 'members.team_id')
        //         ->join('users', 'users.id', '=', 'members.muser_id')
        //         ->where('cuser_id', '=', Auth::user()->id)
        //         ->select('teams.id','teams.name as team_name')
        //         ->distinct()
        //         ->get();

        $teams = DB::table('teams')
                ->join('members', 'teams.id', '=', 'members.team_id')
                ->select('teams.id','teams.name as team_name','members.cuser_id')
                ->where('members.cuser_id', '=', Auth::user()->id)
                ->distinct()
                ->get();

        return response()->json($teams);
    }
    public function viewMember()
    {

        $members  = $teams = DB::table('teams')
                ->join('members', 'teams.id', '=', 'members.team_id')
                ->join('users', 'users.id', '=', 'members.muser_id')
                ->where('members.cuser_id', '=', Auth::user()->id)
                ->select('users.id as member_id', 'users.firstname', 'users.lastname', 'users.email', 'users.address', 'teams.id as team_id','teams.name as team_name', 'users.created_at')
                ->get();

        // echo "<pre>";
        // print_r($members);
        // echo "</pre>";

        return view('viewmember', ['members'=>$members]);
    }
    public function viewMemberById(Request $request, $id){
        $member  = $teams = DB::table('teams')
                ->join('members', 'teams.id', '=', 'members.team_id')
                ->join('users', 'users.id', '=', 'members.muser_id')
                ->where('members.cuser_id', '=', Auth::user()->id)
                ->where('users.id', '=', $id)
                ->select('users.id as member_id', 'users.firstname', 'users.lastname', 'users.email', 'users.address', 'teams.id as team_id','teams.name as team_name', 'users.created_at')
                ->get();

        //print_r($member);

        return view('memberdetails',['member'=>$member[0]]);
    }
    public function getEditMemberName($id)
    {
        //print_r($id);
       
        $member = DB::table('users')
                ->where('id', '=', $id )
                ->select('id','firstname','lastname')
                ->get();

        return view('updatename', ['member'=>$member[0]]);
    }

    public function updateName(Request $request)
    {
       // print_r($request->all());
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/company/member/edit/name/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $member = User::find($request->id);
            $member->firstname = $request->firstname;
            $member->lastname  = $request->lastname;
            $member->save(); 
            return redirect('/company/member/view/'.$request->id);
        }

        
    }

    public function getEditMemberEmail($id)
    {
        //print_r($id);
       
        $member = DB::table('users')
                ->where('id', '=', $id )
                ->select('id','email')
                ->get();

        return view('updateemail', ['member'=>$member[0]]);
    }

    public function updateEmail(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email,'.$request->id,
        ]);

        if ($validator->fails()) {
            return redirect('/company/member/edit/email/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $member = User::find($request->id);
            $member->email = $request->email;
            $member->save(); 
            return redirect('/company/member/view/'.$request->id);
        }

    }

    public function getEditMemberPassword($id)
    {
        $member = DB::table('users')
                ->where('id', '=', $id )
                ->select('id')
                ->get();

        return view('updatepassword', ['member'=>$member[0]]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect('/company/member/edit/reset/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            $member = User::find($request->id);
            $member->password = bcrypt($request->password);
            $member->save();
            return redirect('/company/member/view/'.$request->id);
        }
    }

    public function getEditMemberTeamName($id)
    {
        
        $teams = DB::table('teams')
                ->join('companyteams', 'teams.id', '=', 'companyteams.team_id')
                ->where('cuser_id', '=', Auth::user()->id)
                ->select('teams.id','teams.name as team_name')
                ->get();
        $cuser_id = DB::table('users')
                ->join('members', 'users.id', '=', 'members.muser_id')
                ->select('members.team_id')
                ->where('users.id','=',$id)
                ->first();
        $member = DB::table('users')
                ->select('id')
                ->where('id','=',$id)
                ->first();

        $cuser_team_name = DB::table('teams')
                ->where('id', '=', $cuser_id->team_id)
                ->select('teams.name')
                ->get();
        //print_r($member);
        
        return view('changememberteam', ['teams'=>$teams,'member'=>$member, 'cuser_team_name'=>$cuser_team_name[0]]);

    }
    public function updateMemberTeamName(Request $request)
    {
        //dump($request);
        $validator = Validator::make($request->all(), [
            'teamid' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/company/member/edit/team/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }
        else
        {
            // $member = User::find($request->id);
            // $member->team_id = $request->teamid;
            // $member->save();

            DB::table('members')
               ->where('members.cuser_id', '=' , Auth::user()->id)
               ->where('members.muser_id', '=', $request->id)
               ->update(['team_id' => $request->teamid]);

            return redirect('/company/member/view/'.$request->id);
        }
    }
    public function getTeamMembers($teamid)
    {

        $members = DB::table('users')
                    ->join('members', 'users.id', '=', 'members.muser_id')
                    ->select('users.id','users.lastname')
                    ->where('members.team_id', '=', $teamid)
                    ->get();
       
        return response()->json($members);
    }
    public function getMembers(Request $request)
    {
        $members = DB::table('users')
                    ->join('members', 'users.id', '=', 'members.muser_id')
                    ->select('users.id','users.lastname')
                    ->where('members.team_id', '=', $request->team_id)
                    ->where('members.cuser_id', '=', $request->cuser_id)
                    ->get();

        return response()->json($members);
    }
    public function getTask()
    {
        $teamlist = DB::table('teams')
                ->join('companyteams', 'teams.id', '=', 'companyteams.team_id')
                ->where('cuser_id', '=', Auth::user()->id)
                ->select('teams.id','teams.name as team_name')
                ->get();

        $teams = DB::table('teams')
                ->join('members', 'teams.id', '=', 'members.team_id')
                ->select('teams.id','teams.name as team_name','members.cuser_id')
                ->where('members.cuser_id', '=', Auth::user()->id)
                ->distinct()
                ->get();

        // echo "<pre>";
        // print_r($teams);
        // echo "</pre>";

        return view('addtask', ['teams'=>$teams, 'teamlist'=>$teamlist]);
    }

    public function addTask(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // echo "</pre>";
        $sdate = $request->sdate.":00";
        $edate = $request->edate.":00";
        //echo "<br>".$sdate." ".$edate;
        $validator = Validator::make($request->all(), [
            'name'         => 'required|max:255',
            'description'  => 'required|max:255',
            'tstatus'      => 'required|select_validate',
            'teamid'       => 'required|select_validate',
            'members'      => 'required|c_array_length',
        ]);

        if ($validator->fails()) {
            return redirect('/company/task/')
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $members = $request->members;
            $filename =  "";
                
            if($request->hasFile('attachment'))
            {
                $attachment = $request->file('attachment');
                $filename = time().'.'.$attachment->getClientOriginalExtension();
                $attachment->move(public_path('uploads/attachments/'), $filename);
            }
            
            for($i = 0; $i < count($members); $i++){
            
                $newTask = new Task();
                $newTask->name        = $request->name;
                $newTask->description = $request->description;
                $newTask->attach      = $filename;
                $newTask->tstatus     = $request->tstatus;
                $newTask->sdate       = $sdate;
                $newTask->edate       = $edate;
                $newTask->cuser_id    = Auth::user()->id;
                $newTask->muser_id    = $members[$i];
                $newTask->save();
                
                $museremail = DB::table('users')
                             ->where('users.id', '=', $members[$i])
                             ->select('users.email')
                             ->first();

                $data = ['name'        => $request->name, 
                         'description' => $request->description,
                         'tstatus'     => $request->tstatus,
                         'sdate'       => $sdate,
                         'edate'       => $edate,
                         'email'       => $museremail->email
                         ];
                MailAlertController::mailAlertStatusFromCompany($data);
            }
        }

        return redirect('/company/task/view');
    }


    public function viewTask()
    {

        $tasks = DB::table('tasks')
                ->join('users', 'users.id', '=', 'tasks.muser_id')
                ->join('members', 'members.muser_id', '=', 'users.id')
                ->join('teams','teams.id', '=', 'members.team_id')
                ->where('members.cuser_id', '=', Auth::user()->id)
                ->select('tasks.id as task_id','tasks.name as task_name', 'teams.name as team_name', 'teams.id as team_id', 'users.lastname as member_name', 'tasks.muser_id', 'tasks.cuser_id', 'tasks.description', 'tasks.estatus' ,'tasks.attach', 'tasks.tstatus', 'tasks.created_at')
                ->orderBy('tasks.created_at','desc')
                ->get();
        // echo "<pre>";
        // print_r($tasks);
        // echo "</pre>";


        return view('viewtask', ['tasks'=>$tasks]);
    }
    
    public function deleteTask($id)
    {
        //echo $id;
        $delTask = Task::find($id);
        $delTask->delete();
        //print_r($delTask);
        return redirect('/company/task/view');
    }

    public function editTask($id)
    {
        //echo $id;
        $task = DB::table('tasks')
                ->join('users', 'users.id', '=', 'tasks.muser_id')
                ->join('members', 'members.muser_id', '=', 'users.id')
                ->join('teams','teams.id', '=', 'members.team_id')
                ->where('members.cuser_id', '=', Auth::user()->id)
                ->where('tasks.id', '=', $id)
                ->select('tasks.id as task_id','tasks.name as task_name', 'description')
                ->get();
       
        // echo '<pre>';
        // print_r($task);
        // echo '</pre>';

        return view('edittask', ['task'=>$task[0]]);
    }
    public function updateTask(Request $request){


        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';

        $validator = Validator::make($request->all(), [
            'name'         => 'required|max:255',
            'description'  => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect('/company/task/edit/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $updateTask = Task::find($request->id);
            $updateTask->name        = $request->name;
            $updateTask->description = $request->description;
            $updateTask->save();



            // $data = ['name'        => $request->name, 
            //          'description' => $request->description,
            //          'tstatus'     => $request->tstatus,
            //          'email'       => $museremail->email
            //         ];
            // MailAlertController::mailAlertStatusFromCompany($data);

            return redirect('/company/task/view');

        }

    }

    public function statusChangeTask(Request $request, $task_id)
    {
        DB::table('tasks')
            ->where('id', $task_id)
            ->update(['tstatus' => $request->tstatus]);

        $taskdetails = DB::table('tasks')
            ->where('id', '=', $task_id)
            ->first();

        $museremail = DB::table('users')
                    ->where('users.id', '=', $taskdetails->muser_id)
                    ->select('users.email')
                    ->first();
        $data = [
                 'name'        => $taskdetails->name, 
                 'description' => $taskdetails->description,
                 'tstatus'     => $taskdetails->tstatus,
                 'email'       => $museremail->email
                ];
        MailAlertController::mailAlertStatusFromCompany($data);
                
        return response()->json($request);
    }
}
