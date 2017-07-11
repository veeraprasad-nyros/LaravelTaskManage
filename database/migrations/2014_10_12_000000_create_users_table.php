<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullable();
            $table->string('lastname');
            $table->string('email')->unique();
            $table->integer('role_id')->unsigned();
            $table->string('password');
            $table->string('address')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')
                    ->onUpdate('cascade');
        });

        Schema::create('members', function(Blueprint $table){
            $table->integer('cuser_id')->unsigned(); 
            $table->integer('team_id')->unsigned();
            $table->integer('muser_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('cuser_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams');
            $table->foreign('muser_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            //$table->primary('cuser_id','team_id',  'muser_id' );
            //ALTER TABLE members ADD CONSTRAINT cid_tid_pk PRIMARY KEY ( cuser_id, team_id, muser_id )
        });
         Schema::create('companyteams', function(Blueprint $table){
            $table->integer('cuser_id')->unsigned(); 
            $table->integer('team_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('cuser_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams');
           

            //$table->primary('cuser_id','team_id' );
            //ALTER TABLE companyteams ADD CONSTRAINT cid_tid_pk PRIMARY KEY ( cuser_id, team_id )
        });
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('tstatus')->nullable();
            $table->integer('cuser_id')->unsigned(); 
            $table->integer('muser_id')->unsigned();
                                        
            $table->timestamps();

            $table->foreign('cuser_id')->references('id')->on('users');
                //->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('muser_id')->references('id')->on('users');
                //->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tasks');
        Schema::drop('companyteams');
        Schema::drop('members');
        Schema::drop('users');
        Schema::drop('teams');
        Schema::drop('roles');
    }
}
