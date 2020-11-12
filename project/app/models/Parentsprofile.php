<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Parentsprofile extends Eloquent{

    public $timestamps = [];

    protected $fillable= ['parentName','nic','address','mobileno', 'email', 'password', 'status', 'type'];

    public function getlogin(){
        if(isset($_REQUEST['email']) && isset($_REQUEST['password'])){
            $email = stripslashes($_REQUEST['email']);
            $password = stripslashes($_REQUEST['password']);


        }
    }

}