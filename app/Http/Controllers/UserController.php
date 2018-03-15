<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

use Illuminate\Support\Facades\Auth;
 
use App\Comment;

class UserController extends Controller
{
    //
    public function getDanhSach()
    {
    	$user = User::all();
    	return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getThem()
    {
    	// $theloai = TheLoai::all();
     //    $loaitin = LoaiTin::all();
    	return view('admin.user.them');
    }
    public function postThem(Request $request)
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
        $user->quyen = $request->quyen;
       
        $user->save();
        return redirect('admin/user/them')->with('thongbao','Thêm Thành Công!');
        


        

    }
    public function getSua($id)
    {   
    	
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);

    }
    public function postSua(Request $request, $id)
    {   

        

        $this->validate($request,
            [
                'name'=>'required|min:3'
                
            ],
            [
                'name.required'=>'Bạn chưa nhập tên người dùng',
                'name.min'=>'Tên phải có ít nhất 3 ký tự'
                
                
                
            ]);
        
        $user =User::find($id);
        $user->name = $request->name;     
        $user->quyen = $request->quyen;
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
        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa Thành Công!');
        
    }
    public function getXoa($id)
    {
      $user = User::find($id);
      $comment = Comment::where('idUser',$id); //Tìm các comment của user
      $comment->delete(); //Xóa các comment của user
      $user->delete(); //Xóa user
      return redirect('admin/user/danhsach')->with('thongbao','Xóa tài khoản thành công!');
  	}
  	public function getDangnhapAdmin()
    {
      return view('admin.login');
  	}
    public function postDangnhapAdmin(Request $request)
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
                return redirect('admin/theloai/danhsach');
            }
        else
            {
                return redirect('admin/dangnhap')->with('thongbao', 'Đăng nhập thất bại!');
            }
        }
        
    
    public function getDangxuatAdmin()
    {

        Auth::logout();
        return redirect('admin/login');
        
    }
}


