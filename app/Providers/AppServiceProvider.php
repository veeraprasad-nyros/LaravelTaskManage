<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Validator;
use App\Team;
use App\Task;
use App\Companyteam;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('dup_team_exists', function($attribute, $value, $parameters, $validator)
        {

            $count = DB::table('teams')
                ->join('companyteams', 'teams.id', '=', 'companyteams.team_id')
                ->where('cuser_id', '=', Auth::user()->id)
                ->where('name','=', $value)
                ->count();
              
            if($count == 0){
                return true;
            }
            return false;
        });

        Validator::extend('c_array_length', function($attribute, $value, $parameters, $validator)
        {
            if($value == null)
                return true;

            $length = count($value);
              
            if($length == 0){
                return false;
            }
            return true;
        });

        Validator::extend('select_validate', function($attribute, $value, $parameters, $validator)
        {
                         
            if($value == -1){
                return false;
            }
            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
