<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Food extends Eloquent{
    public $timestamps = [];

    protected $fillable= ['foodname','foodtype','sub1','sub2','sub3'];
}