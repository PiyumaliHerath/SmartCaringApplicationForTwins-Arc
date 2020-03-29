<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Student extends Eloquent
{

    public $timestamps = [];

    protected $fillable = ['id','firstname','lastname', 'gender', 'address', 'birthday', 'hoursofchildcare', 'daysofweek', 'parent', 'ename', 'ephoneno','height', 'weight','medicationallergies','foodallergies', 'foodprefference', 'cronichealthconsern','narrations', 'specialnotes'];
}