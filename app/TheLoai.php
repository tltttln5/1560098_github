<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table = "TheLoai";

    public function loaitin(){
    	return $this->hasMany('App\LoaiTin','idTheLoai', 'id');
    }
    public function tintuc(){
    	return $this->hasManyThroungh('App\TinTuc', 'App\LoaiTin', 'idTheLoai', 'idLoaiTin', 'id');
    }
}
