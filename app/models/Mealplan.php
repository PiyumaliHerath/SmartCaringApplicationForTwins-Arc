<?php

use Illuminate\Database\Eloquent\Model as Eloquent;


class Mealplan extends Eloquent{
    public $timestamps = [];

    protected $fillable= ['mbreakfast','tubreakfast','wbreakfast','thbreakfast' ,'fbreakfast' ,'mmsnack','tumsnack','wmsnack','thmsnack','fmsnack','mlunch' , 'tulunch','wlunch' ,'thlunch','flunch','mlsnack','tulsnack','wlsnack' ,'thlsnack' ,'flsnack' ];

    public function food(){
        return $this->belongsToMany('App\Models\Food');
    }
}