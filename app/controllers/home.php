<?php

class Home extends Controller{

    public function homepage(){
        $this->view('home/home');
    }

    public function login(){
        $this->view('login/login');
    }

    public function index(){

    }
}