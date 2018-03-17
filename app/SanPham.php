<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    //
    protected $table = "sanpham";
    public $timestamps = false;
    public function loaisanpham1()
    {
        return $this->belongsTo('App\LoaiSanPham','id_loaisanpham', 'id');
    }

}
