<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;

class PagesController extends Controller
{
    //
    function __construct()
    {
    	$theloai = TheLoai::all();
    	$slide = Slide::all();
    	view()->share('theloai', $theloai);
    	view()->share('slide',$slide);
    }
    function trangchu()
    {
    	
    	return view('pages.trangchu'); 
    }
    function lienhe()
    {
    	
    	return view('pages.lienhe');
    }
}
