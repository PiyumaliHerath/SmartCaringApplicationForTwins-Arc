<?php

class Admin extends Controller{

    protected $user;

    public function __construct() {
        $this->user = $this->model("Parentsprofile");
    }

    public function parentreg(){
        $this->session();
        $this->view('ParentReg/parentreg');
    }

    public function studentreg(){
        $this->session();
        $parents = $this->user::where('type', 'parent')->get();
        $this->view('StudentReg/studentreg', $parents);
    }

    public function teacherreg(){
        $this->session();
        $this->view('TeacherReg/teacherreg');
    }

    public function mealplan(){
        $this->session();
        $this->view('MealPlan/mealplan');
    }

    public function session(){
        if(empty($_SESSION['login_email'])){
            header("location: /daycare-pure/public/home/login?error=");
            exit();
        }
    }

    public function newparent(){
    $validstatus = true;
    if($_GET['password'] != $_GET['repassword']){
        $error = "Paswords not matched !!";
        $validstatus = false;
        header("location: /daycare-pure/public/admin/parentreg?error=".$error.'&success=');
    }

    $finduser = $this->user::where('email', $_GET['email'])->first();
    if($finduser!=null){
        $error = "Email Existed !! ";
        $validstatus = false;
        header("location: /daycare-pure/public/admin/parentreg?error=".$error.'&success=');
    }
    if($validstatus ){
        $this->user->create([
            'parentName' => $_GET['parentName'],
            'nic' => $_GET['nic'],
            'address' => $_GET['address'],
            'mobileno' => $_GET['mobileno'],
            'email' => $_GET['email'],
            'password' => $_GET['password'],
            'status' => 0,
            'type' => 'parent'
        ]);
        $success = "Parent Added Successfully !!";
        header("location: /daycare-pure/public/admin/parentreg?error=&success=".$success);
    }


}

    public function newteacher(){
        $validstatus = true;
        if($_GET['password'] != $_GET['repassword']){
            $error = "Paswords not matched !!";
            $validstatus = false;
            header("location: /daycare-pure/public/admin/teacherreg?error=".$error.'&success=');
        }

        $finduser = $this->user::where('email', $_GET['email'])->first();
        if($finduser!=null){
            $error = "Email Existed !! ";
            $validstatus = false;
            header("location: /daycare-pure/public/admin/teacherreg?error=".$error.'&success=');
        }
        if($validstatus ){
            $this->user->create([
                'parentName' => $_GET['parentName'],
                'nic' => $_GET['nic'],
                'address' => $_GET['address'],
                'mobileno' => $_GET['mobileno'],
                'email' => $_GET['email'],
                'password' => $_GET['password'],
                'status' => 0,
                'type' => 'teacher'
            ]);
            $success = "Teacher Added Successfully !!";
            header("location: /daycare-pure/public/admin/teacherreg?error=&success=".$success);
        }


    }


}