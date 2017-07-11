<?php
use App\Role;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::auth();
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => '/company', 'middleware' => ['role:company']], function() {
	//stats
	Route::group(['prefix'=>'stats'],function(){
		Route::get('/', 'StatsController@getCompanyStats');
		Route::get('/dashboard', 'StatsController@getDashboard');
	});
	Route::group(['prefix' => '/team'], function() {
		//Route::get('/', 'CompanyController@getTeam');
		Route::get('/exist/{name}', 'CompanyController@teamExist');
		Route::get('/info', 'CompanyController@teamInfo');
		Route::get('/newmember','CompanyController@newMember');
		Route::get('/add/{name}','CompanyController@addTeam');
		Route::get('/view', 'CompanyController@viewTeam');
		Route::get('/members/{teamid}', 'CompanyController@getTeamMembers');
		Route::get('/members', 'CompanyController@getMembers');
    });

	Route::group(['prefix' => '/member'], function() {
		Route::get('/', 'CompanyController@getMember');
		Route::post('/add', 'CompanyController@addMember');
		Route::get('/emailvalidate/{email}', 'CompanyController@emailvalidate');
		Route::get('/view', 'CompanyController@viewMember');
		Route::get('/view/{id}', 'CompanyController@viewMemberById');
		Route::get('/edit/name/{id}', 'CompanyController@getEditMemberName');
		Route::get('/edit/email/{id}', 'CompanyController@getEditMemberEmail');
		Route::get('/edit/reset/{id}', 'CompanyController@getEditMemberPassword');
		Route::get('/edit/team/{id}', 'CompanyController@getEditMemberTeamName');
		Route::post('/name/update', 'CompanyController@updateName');
		Route::post('/email/update', 'CompanyController@updateEmail');
		Route::post('/reset/update', 'CompanyController@updatePassword');
		Route::post('/team/update', 'CompanyController@updateMemberTeamName');
    });
   
    Route::group(['prefix' => '/task'], function() {
		Route::get('/', 'CompanyController@getTask');
		Route::post('/add', 'CompanyController@addTask');
		Route::get('/view', 'CompanyController@viewTask');
		Route::get('/delete/{id}', 'CompanyController@deleteTask');
		Route::get('/edit/{id}', 'CompanyController@editTask');
		Route::get('/update/name/{id}', 'TaskUpdateController@updatTaskName');
		Route::get('/update/description/{id}', 'TaskUpdateController@updatTaskDesc');
		Route::get('/update/status/{id}', 'TaskUpdateController@updatTaskStatus');
		Route::get('/update/member/{id}', 'TaskUpdateController@updatTaskMember');
		Route::get('/attach/download/{id}', 'TaskUpdateController@download');
		Route::get('/attach/view/{id}', 'TaskUpdateController@display');
		Route::get('/attach/remove/{id}', 'TaskUpdateController@removeAttachment');
		Route::post('/attach/change/{id}', 'TaskUpdateController@changeAttachment');
		//Route::get('/attach/change/{id}', 'TaskUpdateController@changeAttachment');
		Route::post('/update', 'CompanyController@updateTask');
		Route::get('/status/{id}', 'CompanyController@statusChangeTask');
    });

}); //company route ended

Route::group(['prefix' => 'members', 'middleware' => ['role:member']], function() {

    Route::get('/tasks', 'AssignedTasksController@viewTasks');
    Route::get('/task/status/{id}', 'AssignedTasksController@statusChangeTask');

}); //member route ended

//Mail Testing routes....
Route::get('/sample', 'MailConfigController@sample');
Route::get('/yahoo', 'MailConfigController@yahoo');
Route::get('/gmail', 'MailConfigController@gmail');
Route::get('/hotmail', 'MailConfigController@hotmail');
Route::get('/general', 'MailConfigController@testGeneral');
