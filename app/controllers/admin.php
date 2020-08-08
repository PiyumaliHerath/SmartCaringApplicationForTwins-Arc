<?php
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class Admin extends Controller{

    protected $user;
    Protected $food;
    Protected $student;
    Protected $mealplan;
    Protected $currentmealplan;
    Protected $gallery;
    Protected $notification;
    Protected $message;
    Protected $event;

    public function __construct() {
        $this->user = $this->model("Parentsprofile");
        $this->food = $this->model("Food");
        $this->student = $this->model("Student");
        $this->mealplan = $this->model("Mealplan");
        $this->currentmealplan = $this->model("CurrentMealplan");
        $this->gallery = $this->model("Gallery");
        $this->notification = $this->model("Notification");
        $this->message = $this->model("message");
        $this->event = $this->model("Event");
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

    public function eventmanagement(){
        $this->session();
        $events = $this->event::get();
        $this->view('eventmanagement/eventmanagement', $events);
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

    public function sendmessagepage(){
        $this->session();
        $student = $this->student::get();
        $this->view('sendmessage/sendmessage',$student);
    }

    public function sendmessage(){
        $student = $this->student::where('id',$_POST['child'])->first();
        date_default_timezone_set('Asia/Colombo');

//        echo date("h-i-a");
        $this->message->create([
            'message' => $_POST['message'],
            'studentid' => $_POST['child'],
            'parentid' => $student->parent,
            'date' => Date("d/m/Y"),
            'time' => date("h-i-a")

        ]);
        $success = "Message Sent !!";
        header("location: /daycare-pure/public/admin/sendmessagepage?error=&success=".$success);
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

    public function searchparent(){
        $this->session();
        $users = $this->user::where('type','parent')->get();
        $this->view('parentsearch/parentsearch',$users);
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

    public function getparentslist(){
        $this->session();
//        echo '<p>'.$_GET["search"].'</p>';
        $output="";
        $parents = $this->user::where('parentname','LIKE','%'.$_GET["search"].'%')->get();
        foreach ($parents as $parent){
            $output.= "<div class='row my-2 container'>
                    <div class='col-md-12'>
                    <div class='card'>
                    <div class='card-body'>
                    <text>$parent->parentName </text>
                    <a href='updateparentpage?success=&error=&id=$parent->id' class='btn btn-primary mx-5'>Edit </a>
</div>
</div>
</div>
</div>
";
        }
        echo $output;
    }

    public function updateparentpage(){
        $user = $this->user::where('id',$_GET['id'])->first();
        $this->view('updateparentpage/updateparentpage', $user);
    }

    public function updateparent(){
        $validstatus = true;
        if($_GET['password'] != $_GET['repassword']){
            $error = "Paswords not matched !!";
            $validstatus = false;
            header("location: /daycare-pure/public/admin/updateparentpage?error=".$error.'&success=&id='.$_GET['id']);
        }

//        $finduser = $this->user::where('email', $_GET['email'])->first();
//        if($finduser!=null){
//            $error = "Email Existed !! ";
//            $validstatus = false;
//            header("location: /daycare-pure/public/admin/updateparentpage?error=".$error.'&success=');
//        }
        if($validstatus ){
            $this->user::where('id',$_GET[id])->update([
                'parentName' => $_GET['parentName'],
                'nic' => $_GET['nic'],
                'address' => $_GET['address'],
                'mobileno' => $_GET['mobileno'],
                'email' => $_GET['email'],
                'password' => $_GET['password'],
            ]);
            $success = "Updated Successfully !!!";
            header("location: /daycare-pure/public/admin/updateparentpage?error=&success=".$success."&id=".$_GET['id']);
        }
    }

    public function studentdetails(){
        $this->session();
        $student = $this->student::where('id', $_GET['student'])->first();
        $this->view('studentdetails/studentdetails', $student);
    }

    public function currentmealplan(){
        $this->session();
        $foodlist = [];
        $meal = $this->currentmealplan::orderBy('id', 'desc')->first();
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
        }else if($_SESSION['type'] != 'teacher'){
            header("location: /daycare-pure/public/home/homepage");
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
           'foodtype' => $_GET['foodtype'],
           'sub1' => $_GET['sub1'],
           'sub2' => $_GET['sub2'],
           'sub3' => $_GET['sub3'],
        ]);
        $success = "Food Added Successfully !!";
        header("location: /daycare-pure/public/admin/foods?error=&success=".$success);
    }

    public function foodremove(){
        $this->food::where('id', $_GET['id'])->delete();
        $success = "Food Deleted Successfully !!";
        header("location: /daycare-pure/public/admin/foods?error=&success=".$success);
    }

    public function eventremove(){
        $this->event::where('id', $_GET['id'])->delete();
        $success = "Event Deleted Successfully !!";
        header("location: /daycare-pure/public/admin/eventmanagement?error=&success=".$success);
    }

    public function eventedit(){
        $event = $this->event::where('id',$_GET['id'])->first();
        $this->view('updateeventpage/updateeventpage', $event);
    }
    public function eventupdate(){

        $this->event::where('id',$_GET[id])->update([
            'title' => $_GET['title'],
            'date' => $_GET['date'],
            'status' => $_GET['status'],
        ]);
        $success = "Event Updated Successfully !!";
        header("location: /daycare-pure/public/admin/eventmanagement?error=&success=".$success);
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

        $this->currentmealplan::truncate();

        $this->currentmealplan->create([
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

        $sms = "New meal plan created";
        $this->sendsms($sms);
        $success = "MealPlan Added Successfully !!";
        header("location: /daycare-pure/public/admin/mealplan?error=&success=".$success);;

    }

    public function newevent(){
        print_r($_GET['status']);
        $this->event->create([
            'title' => $_GET['title'],
            'date' => $_GET['date'],
            'status' => $_GET['status'],
        ]);
        $success = "Event Added Successfully !!";
        header("location: /daycare-pure/public/admin/eventmanagement?error=&success=".$success);

    }

    public function sendsms($message){

        $account_sid = 'ACd2bd3dc1fcc527725d19fb4879aeb40e';
        $auth_token = '16140dad350c285a7afec0c237f17ac3';

        $twilio_number = "+18636243789";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
        // Where to send a text message (your cell phone?)
            '+94710675040',
            array(
                'from' => $twilio_number,
                'body' => $message
            )
        );
    }

    public function videochat(){
        $this->session();

// Substitute your Twilio AccountSid and ApiKey details
        $accountSid = 'ACd2bd3dc1fcc527725d19fb4879aeb40e';
        $apiKeySid = 'SKc55bf58dac121bf63551a603de77f7c5';
        $apiKeySecret = 'lwxn7LeXO4pWUUbacJBYnVne0BFUWnLG';

        $identity = 'example-user';

// Create an Access Token
        $token = new AccessToken(
            $accountSid,
            $apiKeySid,
            $apiKeySecret,
            3600,
            $identity
        );

// Grant access to Video
        $grant = new VideoGrant();
        $grant->setRoom('cool room');
        $token->addGrant($grant);

// Serialize the token as a JWT
        echo $token->toJWT();
        $this->view("videochat/videochat");
    }

}

