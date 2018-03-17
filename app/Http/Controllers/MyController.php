<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

class MyController extends Controller
{
    public function XinChao()
    {
    	echo "xin chao cac ban";
    }
    public function Truyen($nd)
    {
    	echo "Noi dung truyen vao : " .$nd;
    	return redirect()->route('MyRoute');
    }
    public function GetURL(Request $request)
    {
    	return $request->path();
    	//return $request->url(); tra ve duong link
    	//return $request->isMethod('post');
    	//if($request->isMeThod('get'))
    		//echo "phuong thuc get";
    	//else
    		//echo "ko phai phuong thuc get";
    }
    public function postForm(Request $request)
    {	
    	echo "ten cua ban la:";
    	echo $request->HoTen;
    }
    public function setCookie()
    {	
    	$response = new Response();
    	$response->withCookie('KhoaHoc','Laravel - d m',1);
    	echo "Da set cookie";
    	return $response;
    }
    public function getCookie(Request $request)
    {
    	return $request->cookie('KhoaHoc');
    
    }
    //
    public function postFile(Request $request)
    {
    	if($request->hasFile('myFile'))
    	{	
    		$file = $request->file('myFile');
    		//filename = $file->getClientOriginalName('myFile');
    		//echo $filename;
    		$file->move('img','myfile.jpg');
    		echo "co file r";
    	}
    	else
    	{
    		echo "Chua co file";
    	}
    }
    // Json
    public function getJson()
    {
    	$array = ['KhoaHoc'=>'Laravel-KhoaPham'];
    	return response()->json($array);
    }
    public function myView()
    {
    	return view('myView');
    }
    public function Time($t)
    {
    	return view('myView',['time'=>$t]);
    }
    // chuyen page
    public function blade($str)
    {
    	$monhoc1 = "Lap trinh web";
    	
    	if($str=="laravel")
    		return view('pages.laravel',['monhoc1'=>$monhoc1]);
    	elseif ($str=="php")
    		return view('pages.php',['monhoc1'=>$monhoc1]);


    }
    
}

