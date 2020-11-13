<?php
use Twilio\Rest\Client;

class Parents extends Controller{

    protected $user;
    protected $notification;
    Protected $student;
    protected $children;
    protected $mealplan;
    protected $food;
    protected $meal;
    protected $mealfoodarray;
    protected $foods;
    protected $foodlist;
    protected $sid;
    protected $somenotifications;
    protected $notifications;
    protected $child;
    protected $messages;
    protected $message;
    protected $event;
    protected $events;

    public function __construct() {
        $this->user = $this->model("Parentsprofile");
        $this->student = $this->model("Student");
        $this->mealplan = $this->model("Mealplan");
        $this->notification = $this->model("notification");
        $this->food = $this->model("Food");
        $this->message = $this->model("Message");
        $this->event = $this->model("Event");

        $this->children = $this->student::where('parent', $_SESSION['id'])->get();
        $this->meal = $this->mealplan::orderBy('id', 'desc')->first();
        $this->somenotifications = $this->notification::orderBy('id', 'desc')->take(3)->get();
        $this->notifications = $this->notification::orderBy('id', 'desc')->get();
        $this->foods = $this->food::get();
        $this->events = $this->event::get();

        foreach ($this->foods as $food){
            $this->foodlist[$food->id] = "$food->foodname";
        }

        if(isset($_GET['id'])){
            $this->sid = $_GET['id'];
            $this->child =$this->student::where('id', $this->sid)->first();
        }

        $this->mealfoodarray = $this->meal->toArray();

    }

    public function selectchildpage(){
        $this->session();
        $this->view('selectstudentpage/selectstudentpage', $this->children);
    }

    public function allnotifications(){
        $this->session();
        $this->view('allnotifications/allnotifications', $this->notifications);
    }

    public function allevents(){
        $this->session();
        $this->view('allevents/allevents', $this->events);
    }

    public function currentmealplan(){
        $this->session();
        $this->view('currentmealplanforparent/currentmealplanforparent', $this->meal, $this->foodlist);
    }

    public function dashboard(){
        $this->session();
        $tommorowmeal= $this->gettommorowmeal();
        $sid = $_GET['id'];
        $pid = $_SESSION['id'];
        $messages = $this->message::orderBy('id', 'desc')->where('studentid','=', $sid, 'AND', 'parentid','=',$pid)->take(3)->get();

       $this->view('dashboard/dashboard',$tommorowmeal, $this->somenotifications, $messages);
    }
    public function allmessages(){
        $sid = $_GET['id'];
        $pid = $_SESSION['id'];
        $messages = $this->message::orderBy('id', 'desc')->where('studentid','=', $sid, 'AND', 'parentid','=',$pid)->get();
        $this->view('allmessages/allmessages', $messages);
    }

    /*Get Tommrow meal plan*/
    public function gettommorowmeal(){
        $day = date("l",strtotime(' +1 day'));
        //Get the first letter of the day
        $temp = strtolower($day[0]);
        if ($temp == "t"){
            $fletter = substr(strtolower($day),0,2); //if first letter of the day is "t" then it take first two letters
        }else if($temp=="s"){
            $fletter = "s"; //if the day is saturday or sunday
        }else{
            $fletter = $temp;
        }


        if($fletter != "s"){
            //meal names
            $m1 =$fletter."breakfast";
            $m2 =$fletter."msnack";
            $m3 =$fletter."lunch";
            $m4 =$fletter."lsnack";

//to get real name from foodlist
            $m11 = $this->mealfoodarray[$m1];
            $m21 = $this->mealfoodarray[$m2];
            $m31 = $this->mealfoodarray[$m3];
            $m41 = $this->mealfoodarray[$m4];

            $allergicfood = $this->getallergicfoods($m11, $m21, $m31, $m41);


            $tommorowmeal = Array( $fletter,$this->foodlist[$m11],$allergicfood[0],$this->foodlist[$m21],$allergicfood[1], $this->foodlist[$m31], $allergicfood[2],  $this->foodlist[$m41], $allergicfood[3],  $allergicfood[4],  $allergicfood[5], $allergicfood[6], $allergicfood[7]);

            return $tommorowmeal;
        }else{
            $tommorowmeal = Array( $fletter);
            return $tommorowmeal;

        }

    }

    public function getallergicfoods($m11, $m21, $m31, $m41){
        $alergicfoodarray = explode('|', $this->child['foodallergies'] );


//        if food is allergiv then m12, m22 , m32 , m42 become 1 else 0
        $m12 = 0;
        $m22 = 0;
        $m32 = 0;
        $m42 = 0;

//        To get substitute foods
        $a11 =[];
        $a22 =[];
        $a33 =[];
        $a44 =[];


        foreach ($alergicfoodarray as $value){
            if(strcmp($value,$m11) == 0 ){
                $m12 = 1;
                $afood = $this->food::where('id', $m11)->first();
                $a11 = [$afood->sub1, $afood->sub2,$afood->sub3];

            }
            if(strcmp($value,$m21) == 0 ){
                $m22 = 1;
                $afood = $this->food::where('id', $m21)->first();
                $a22 = [$afood->sub1, $afood->sub2,$afood->sub3];

            }if(strcmp($value,$m31) == 0 ){
                $m32 = 1;
                $afood = $this->food::where('id', $m31)->first();
                $a33 = [$afood->sub1, $afood->sub2,$afood->sub3];
            }
            if(strcmp($value,$m41) == 0 ){
                $m42 = 1;
                $afood = $this->food::where('id', $m41)->first();
                $a44 = [$afood->sub1, $afood->sub2,$afood->sub3];
            }
        }

        return array($m12, $m22, $m32, $m42, $a11, $a22, $a33, $a44);

    }

    public function emergencycall(){
        // Your Account SID and Auth Token from twilio.com/console
        $account_sid = 'ACd2bd3dc1fcc527725d19fb4879aeb40e';
        $auth_token = '16140dad350c285a7afec0c237f17ac3';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_ACCOUNT_SID"]

// A Twilio number you own with Voice capabilities
        $twilio_number = "+18636243789";

// Where to make a voice call (your cell phone?)
        $to_number = "+94710675040";

        $client = new Client($account_sid, $auth_token);
        $client->account->calls->create(
            $to_number,
            $twilio_number,
            array(
                "url" => "http://demo.twilio.com/docs/voice.xml"
            )
        );
        $this->dashboard();

    }





    public function session(){
        if(empty($_SESSION['login_email'])){
            header("location: /daycare-pure/public/home/login?error=");
            exit();
        }else if($_SESSION['type'] != 'parent'){
            header("location: /daycare-pure/public/home/homepage");
            exit();
        }
    }


}