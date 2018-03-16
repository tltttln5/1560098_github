<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;

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
    function loaitin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
        
        return view('pages.loaitin',['loaitin'=>$loaitin, 'tintuc'=>$tintuc]);
    }
    function tintuc($id)
    {
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat', 1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin )->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc, 'tinnoibat'=>$tinnoibat, 'tinlienquan'=>$tinlienquan]);
    }
    function getDangnhap()
    {
        return view('pages.dangnhap');
    }
    function postDangnhap(Request $request)
    {
        $this->validate($request, [
            'email'=>'required',
            'password'=>'required|min:3|max:32'
        ],[
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập password',
            'password.min'=>'password không được nhỏ hơn 3 ký tự',
            'password.max'=>'password không lớn hơn 100 ký tự'
        ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))

        {
            return redirect('trangchu');
        }
        else
        {
            return redirect('dangnhap')->with('thongbao', 'Đăng nhập thất bại!');
        }
        
    }
    function getDangXuat()
    {
        Auth::logout();
        return redirect('trangchu');

    }
    function getNguoidung()
    {
        $user = Auth::user();
        return view('pages.nguoidung',['nguoidung'=>$user]);
    }
    function postNguoidung()
    {
        
    }
}   


