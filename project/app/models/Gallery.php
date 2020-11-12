<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Gallery extends Eloquent{
    public $timestamps = [];

    protected $fillable= ['imagename','uploadedby'];
}