<?php

class Admin extends Controller{

    protected $user;
    Protected $food;
    Protected $student;
    Protected $mealplan;
    Protected $gallery;
    Protected $notification;

    public function __construct() {
        $this->user = $this->model("Parentsprofile");
        $this->food = $this->model("Food");
        $this->student = $this->model("Student");
        $this->mealplan = $this->model("Mealplan");
        $this->gallery = $this->model("Gallery");
        $this->notification = $this->model("Notification");
    }

    public function parentreg(){
        $this->session();
        $this->view('ParentReg/parentreg');
    }

    public function studentreg(){
        $this->session();
        $parents = $this->user::where('type', 'parent')->get();
        $foods = $this->food::get();
        $this->view('StudentReg/studentreg', $parents, $foods);
    }

    public function teacherreg(){
        $this->session();
        $this->view('TeacherReg/teacherreg');
    }

    public function mealplan(){
        $this->session();
        $foods = $this->food::get();
        $this->view('MealPlan/mealplan', $foods);
    }

    public function uploadimage(){
        $this->session();
        $this->view("uploadimage/uploadimage");
    }

    public function foods(){
        $this->session();
        $foods = $this->food::get();
        $this->view('foods/foods', $foods);
    }

    public function notificationpage(){
        $this->session();
        $this->view('notificationpage/notificationpage');
    }

    public function notification(){
        $message =  $_GET['message'];
        $type =  $_GET['type'];

        $result = $this->sentnotification($message, $type);

        if($result){
            $success = "Notification Added Successfully !!";
            header("location: /daycare-pure/public/admin/notificationpage?error=&success=".$success);
        }
    }

    public function sentnotification($message, $type){
        $this->notification->create([
            'message' => $message,
            'type' => $type,
            'status' => 0
        ]);
        return true;
    }

    public function searchstudent(){
        $this->session();
        $student = $this->student::get();
        $this->view('studentsearch/studentsearch',$student);
    }

    public function submitimagetogallery(){
        $this->session();
        if (isset($_POST['submitbtn'])) {
                $uploadimage = $_FILES["uploadimage"];
                $name = date("h-i-sa"). $uploadimage["name"];

                if(move_uploaded_file($uploadimage["tmp_name"], "../../daycare-pure/public/uploadimages/gallery/".$name )){
                   $this->gallery->create([
                       "imagename" => $name,
                       "uploadedby" =>  $_SESSION['login_email']
                   ]);
                   $success = "Successfull added !!";
                    header("location: /daycare-pure/public/admin/uploadimage?error=&success=".$success);
                }else{
                    echo "Error";
                };


        }else{
            echo "Somthing wrong";
        }


    }

    public function getstudentslist(){
        $this->session();
//        echo '<p>'.$_GET["search"].'</p>';
        $output="";
        $students = $this->student::where('firstname','LIKE','%'.$_GET["search"].'%')->get();
        foreach ($students as $student){
            $output.= "<div class='row my-2 container'>
                    <div class='col-md-12'>
                    <div class='card'>
                    <div class='card-body'>
                    <a href='studentdetails?student=$student->id'>$student->firstname $student->lastname</a>
</div>
</div>
</div>
</div>
";
        }
        echo $output;
    }

    public function studentdetails(){
        $this->session();
        $student = $this->student::where('id', $_GET['student'])->first();
        $this->view('studentdetails/studentdetails', $student);
    }

    public function currentmealplan(){
        $this->session();
        $foodlist = [];
        $meal = $this->mealplan::orderBy('id', 'desc')->first();
        $foods = $this->food::get();
        $student = $this->student::get();
        $alergicchild =[];


        $mealfoodarray = $meal->toArray();

//        print_r($mealfoodarray);
        foreach ($foods as $food){
            $foodlist[$food->id] = "$food->foodname";
        }

        foreach ($student as $child){

            if($child->foodallergies != ''){
                $alergicfoodarray = explode('|', $child->foodallergies );

                $temp = [];

                foreach ($alergicfoodarray as $value){

                    if( in_array($value, $mealfoodarray)){
                        array_push($temp, $value);
                    }

                }

                if ($temp != null){
                    array_unshift($temp,$child->firstname, $child->lastname);
                }

                array_push($alergicchild, $temp);



            }

        }



        $this->view('currentmealplan/currentmealplan', $meal, $foodlist,$alergicchild);
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

    public function newfood(){
        $this->food->create([
           'foodname' => $_GET['foodname'],
           'foodtype' => $_GET['foodtype']
        ]);
        $success = "Food Added Successfully !!";
        header("location: /daycare-pure/public/admin/foods?error=&success=".$success);
    }

    public function foodremove(){
        $this->food::where('id', $_GET['id'])->delete();
        $success = "Food Deleted Successfully !!";
        header("location: /daycare-pure/public/admin/foods?error=&success=".$success);
    }

    public function newstudent(){

        $selectedfoodarray = [];

        foreach ($_POST['foodallergies'] as $foodallergy){
            array_push($selectedfoodarray, $foodallergy);
        }


            $uploadimage = $_FILES["photo"];
            $name = date("h-i-sa"). $uploadimage["name"];

            if(move_uploaded_file($uploadimage["tmp_name"], "../../daycare-pure/public/uploadimages/babies/".$name )){
                $uploadname = $name;
            }



        $this->student->create([
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'gender' => $_POST['gender'],
            'address' => $_POST['address'],
            'birthday' => $_POST['birthday'],
            'hoursofchildcare' => $_POST['hoursofchildcare'],
            'daysofweek' => $_POST['daysofweek'],
            'parent' => $_POST['parent'],
            'photo'=> $uploadname,
            'ename' => $_POST['ename'],
            'ephoneno' => $_POST['ephoneno'],
            'height' => $_POST['height'],
            'weight' => $_POST['weight'],
            'medicationallergies' => $_POST['medicationallergies'],
            'foodallergies' => implode('|',$selectedfoodarray),
            'foodprefferenec' => $_POST['foodprefference'],
            'cronichealthconsern' => $_POST['cronichealthconsern'],
            'narrations' => $_POST['narrations'],
            'specialnotes' => $_POST['specialnotes'],
        ]);

        $success = "Student Added Successfully !!";
        header("location: /daycare-pure/public/admin/studentreg?error=&success=".$success);
    }

    public function newmealplan(){
        $this->mealplan->create([
            'mbreakfast' => $_GET['mbreakfast'],
            'tubreakfast' => $_GET['tubreakfast'],
            'wbreakfast' => $_GET['wbreakfast'],
            'thbreakfast' => $_GET['thbreakfast'],
            'fbreakfast' => $_GET['fbreakfast'],
            'mmsnack' => $_GET['mmsnack'],
            'tumsnack' => $_GET['tumsnack'],
            'wmsnack' => $_GET['wmsnack'],
            'thmsnack' => $_GET['thmsnack'],
            'fmsnack' => $_GET['fmsnack'],
            'mlunch' => $_GET['mlunch'],
            'tulunch' => $_GET['tulunch'],
            'wlunch' => $_GET['wlunch'],
            'thlunch' => $_GET['thlunch'],
            'flunch' => $_GET['flunch'],
            'mlsnack' => $_GET['mlsnack'],
            'tulsnack' => $_GET['tulsnack'],
            'wlsnack' => $_GET['wlsnack'],
            'thlsnack' => $_GET['thlsnack'],
            'flsnack' => $_GET['flsnack'],

        ]);
        $success = "MealPlan Added Successfully !!";
        header("location: /daycare-pure/public/admin/mealplan?error=&success=".$success);;

    }


}