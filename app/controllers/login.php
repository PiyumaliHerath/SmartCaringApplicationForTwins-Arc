<?php


class Login extends Controller
{
    protected $user;

    public function __construct() {
        $this->user = $this->model("Parentsprofile");
    }
    public function index(){
        session_start();
        if(isset($_REQUEST['email']) && isset($_REQUEST['password'])) {
            $email = stripslashes($_REQUEST['email']);
            $password = stripslashes($_REQUEST['password']);

            $finduser = $this->user::where('email', $email)->first();
            if($finduser != null){
                if($password == $finduser->password){
//                    session_register('email');
                    $_SESSION['login_email'] = $finduser->email;
                    $_SESSION['user_name'] = $finduser->parentName;
                    header("location: /daycare-pure/public/admin/studentreg");

                }
            }else{
                $error = "Your email or password is incorrect";
                header("location: /daycare-pure/public/home/login?error=".$error);
            }

        }
    }

    public function logout(){
            session_start();
            session_destroy();
        header("location: /daycare-pure/public/home/homepage");
    }
}