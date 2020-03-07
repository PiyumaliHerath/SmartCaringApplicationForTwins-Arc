<?php


class Login extends Controller
{
    protected $user;

    public function __construct() {
        $this->user = $this->model("Parentsprofile");
    }

   public function invoke(){

       if(isset($_REQUEST['email']) && isset($_REQUEST['password'])){
           $email = stripslashes($_REQUEST['email']);
           $password = stripslashes($_REQUEST['password']);

           $finduser = $this->user::where('email', $email)->first();
           if($finduser != null){
               header("https://www.google.com/");
           }
       }

//       $result = $this->model-getlogin();
//
//       if($result == "login"){
//           echo "Login Successfully";
//       }

   }
}