<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Event extends Eloquent{
    public $timestamps = [];

    protected $fillable= ['title','date','status'];
}