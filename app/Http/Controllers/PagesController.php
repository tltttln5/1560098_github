<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;

class PagesController extends Controller
{
    //
    function __construct()
    {
    	$theloai = TheLoai::all();
    	$slide = Slide::all();
    	view()->share('theloai', $theloai);
    	view()->share('slide',$slide);
        if(Auth::check())
            {
                view()->share('nguoidung', Auth::user());
            }
       
    }
    function trangchu()
    {
    	
    	return view('pages.trangchu'); 
    }
    function lienhe()
    {
    	
    	return view('pages.lienhe');
    }
    function gioithieu()
    {
        return view('pages.gioithieu');
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
        
        return view('pages.nguoidung');
    }
    function postNguoidung(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required|min:3'
                
            ],
            [
                'name.required'=>'Bạn chưa nhập tên người dùng',
                'name.min'=>'Tên phải có ít nhất 3 ký tự'
                
                
                
            ]);
        
        $user = Auth::user();
        $user->name = $request->name;     
        
        if ($request->changePassword == "on")
        {
            $this->validate($request,
            [
                
                'password'=>'required|min:3|max:32',  
                'passwordAgain'=>'required|same:password'
            ],
            [
                

                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max'=>'Mật khẩu chỉ tối đa 32 ký tự',
                'passwordAgain.required'=>'Bạn chưa nhập mật khẩu',
                'passwordAgain.same'=>'Mật khẩu nhập chưa trùng khớp'
            ]);
        }
        $user->password = bcrypt($request->password);
        
       
        $user->save();
        return redirect('nguoidung')->with('thongbao','Sửa Thành Công!');
    }
    function getDangky()
    {
        return view('pages.dangky');
    }
    function postDangky(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required|min:3',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:3|max:32',  
                'passwordAgain'=>'required|same:password'
            ],
            [
                'name.required'=>'Bạn chưa nhập tên người dùng',
                'name.min'=>'Tên phải có ít nhất 3 ký tự',
                
                
                'email.required'=>'Bạn chưa nhập email',
                'email.email'=>'Bạn chưa đúng định dạng email',
                'email.unique'=>'Email đã tồn tại',

                'password.required'=>'Bạn chưa nhập password',
                'password.min'=>'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max'=>'Mật khẩu chỉ tối đa 32 ký tự',
                'passwordAgain.required'=>'Bạn chưa nhập mật khẩu',
                'passwordAgain.same'=>'Mật khẩu nhập chưa trùng khớp'
            ]);
        $user = new User;
        $user->name = $request->name;     
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0;
       
        $user->save();
        return redirect('dangnhap')->with('thongbao','Đăng ký tài khoản thành công!');
    }
    function Timkiem(Request $request)
    {   
        $tukhoa = $request->get('tukhoa');
        // $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->take(30)->paginate(5);
        $tintuc = TinTuc::where('TieuDe','like','%'.$tukhoa.'%')->orWhere('TomTat','like','%'.$tukhoa.'%')->orWhere('NoiDung','like','%'.$tukhoa.'%')->paginate(5);

        return view('pages.timkiem',['tintuc' => $tintuc, 'tukhoa' => $tukhoa]);
        // $tukhoa = $request->tukhoa;
        // $tukhoa=$request->get('tukhoa');
        // $tintuc = TinTuc::where('TieuDe','like','%'.$tukhoa.'%')->orWhere('TomTat','like','%'.$tukhoa.'%')->orWhere('NoiDung','like','%'.$tukhoa.'%')->paginate(5);
        // return view('pages.timkiem',['tukhoa'=>$tukhoa,'tintuc'=>$tintuc]);

    }
}   


