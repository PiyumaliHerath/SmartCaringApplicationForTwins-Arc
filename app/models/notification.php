<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Notification extends Eloquent{
    public $timestamps = [];

    protected $fillable= ['message','type', 'status'];
}