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

class TaskUpdateController extends Controller
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

    public function updatTaskName(Request $request, $id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->update(['name' => $request->data]);

        return response()->json(["status" => "succuess"]);
    }
    
    public function updatTaskDesc(Request $request, $id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->update(['description' => $request->data]);

        return response()->json(["status" => "succuess"]);
    }

    public function updatTaskStatus(Request $request, $id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->update(['tstatus' => $request->data]);

        return response()->json(["status" => "succuess"]);
    }

    public function updatTaskMember(Request $request, $id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->update(['muser_id' => $request->data]);

        return response()->json(["status" => "succuess"]);
    }

    public function removeAttachment(Request $request, $id)
    {
        DB::table('tasks')
            ->where('id', $id)
            ->update(['attach' => null]);


        return response()->json($request->id);
    }

    public function changeAttachment(Request $request, $id)
    {
               
        if($request->hasFile('attach'))
        {
            $attachment = $request->file('attach');
            $filename = time().'.'.$attachment->getClientOriginalExtension();
            $attachment->move(public_path('uploads/attachments/'), $filename);
            DB::table('tasks')
               ->where('id', $id)
               ->update(['attach' => $filename]);
            return response()->json(['filename'=>$filename]);
        }
      
        return response()->json('error');
       
    }

    public function download(Request $request, $id)
    {
       $filename =  DB::table('tasks')->select('attach')->where('id', $id)->first();
       $filename = $filename->attach;
       $path = public_path('/uploads/attachments/'.$filename);

       $header   = ['Content-Type:'.$this->getMime($path)];
       
       return response()->download($path, $filename, $header);
    }

    public function display(Request $request, $id)
    {
        $filename =  DB::table('tasks')->select('attach')->where('id', $id)->first();
        $filename = $filename->attach;
        $path = public_path('/uploads/attachments/'.$filename);
        $mtype = $this->getMime($path);
        return response()->make(file_get_contents($path), 200, [
            'Content-Type' => $mtype,
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);

    }
    public function getMime($path)
    {
        $mime_type=array(
            "pdf" => "application/pdf",
            "txt" => "text/plain",
            "html" => "text/html",
            "htm" => "text/html",
            "exe" => "application/octet-stream",
            "zip" => "application/zip",
            "doc" => "application/msword",
            "xls" => "application/vnd.ms-excel",
            "ppt" => "application/vnd.ms-powerpoint",
            "gif" => "image/gif",
            "png" => "image/png",
            "jpeg"=> "image/jpg",
            "jpg" =>  "image/jpg",
            "php" => "text/plain"
        );

        $extension = explode(".",$path);
        $extension = $extension[count($extension)-1];
        
        return array_get($mime_type, $extension);
    }
}
