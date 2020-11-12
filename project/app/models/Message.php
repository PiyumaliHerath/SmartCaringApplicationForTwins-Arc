<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Message extends Eloquent{
    public $timestamps = [];

    protected $fillable= ['message','studentid', 'parentid', 'date','time'];
}