<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Parentsprofile extends Eloquent{

    public $timestamps = [];

    protected $fillable= ['parentname','nic','address', 'email', 'password', 'status', 'type'];

    public function getlogin(){
        if(isset($_REQUEST['email']) && isset($_REQUEST['password'])){
            $email = stripslashes($_REQUEST['email']);
            $password = stripslashes($_REQUEST['password']);


        }
    }

}