<?php

class Parents extends Controller{

    protected $user;
    Protected $student;
    protected $children;
    protected $mealplan;
    protected $food;
    protected $meal;
    protected $mealfoodarray;
    protected $foods;
    protected $foodlist;
    protected $sid;
    protected $child;

    public function __construct() {
        $this->user = $this->model("Parentsprofile");
        $this->student = $this->model("Student");
        $this->mealplan = $this->model("Mealplan");
        $this->food = $this->model("Food");

        $this->children = $this->student::where('parent', $_SESSION['id'])->get();
        $this->meal = $this->mealplan::orderBy('id', 'desc')->first();
        $this->foods = $this->food::get();

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

    public function currentmealplan(){
        $this->session();
        $this->view('currentmealplanforparent/currentmealplanforparent', $this->meal, $this->foodlist);
    }

    public function dashboard(){
        $this->session();
        $tommorowmeal= $this->gettommorowmeal();
        print_r($tommorowmeal);
       $this->view('dashboard/dashboard',$tommorowmeal);
    }

    /*Get Tommrow meal plan*/
    public function gettommorowmeal(){
        $day = date("l",strtotime(' +1 day'));
        //Get the first letter of the day
        $temp = strtolower($day[0]);
        if ($temp == "t"){
            $fletter = substr(strtolower($day),0,2); //if first letter of the day is "t" then it take first two letters
        }else if($temp=="s"){
            $fletter = "w"; //if the day is saturday or sunday
        }else{
            $fletter = $temp;
        }


        if($fletter != "w"){
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

            $tommorowmeal = Array( $fletter,$this->foodlist[$m11],$allergicfood[0],$this->foodlist[$m21],$allergicfood[1], $this->foodlist[$m31], $allergicfood[2],  $this->foodlist[$m41], $allergicfood[3]);

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

        foreach ($alergicfoodarray as $value){
            if(strcmp($value,$m11) == 0 ){
                $m12 = 1;
            }
            if(strcmp($value,$m21) == 0 ){
                $m22 = 1;
            }if(strcmp($value,$m31) == 0 ){
                $m32 = 1;
            }
            if(strcmp($value,$m41) == 0 ){
                $m42 = 1;
            }
        }

        return array($m12, $m22, $m32, $m42);

    }

    public function session(){
        if(empty($_SESSION['login_email'])){
            header("location: /daycare-pure/public/home/login?error=");
            exit();
        }
    }


}