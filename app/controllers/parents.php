<?php

class Parents extends Controller{

    protected $user;

    public function __construct() {
        $this->user = $this->model("Parentsprofile");
    }


}