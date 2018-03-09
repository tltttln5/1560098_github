<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;

class TinTucController extends Controller
{
    //
    public function getDanhSach()
    {
    	$tintuc = TinTuc::orderBy('id', 'DESC')->get();
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getThem()
    {
    	$theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
    	return view('admin.tintuc.them',['theloai'=>$theloai],['loaitin'=>$loaitin]);
    }
    public function postThem(Request $request)
    {
    	$this->validate($request,
            [
                'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai'=>'required'   
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên loại tin',
                'Ten.unique'=>'Tên loại tin đã tồn tại',
                'Ten.min'=>'Ký tự phải có độ dài từ 3->100 ký tự.',
                'Ten.max'=>'Ký tự phải có độ dài từ 3->100 ký tự.',
                'TheLoai.required'=>'Bạn chưa chọn thể loại'
            ]);
        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công!');


        

    }
    public function getSua($id)
    {   
    	$theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);

    }
    public function postSua(Request $request, $id)
    {   

        $this->validate($request,
            [
                'Ten'=>'required|unique:LoaiTin,Ten|min:3|max:100',
                'TheLoai'=>'required'   
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên loại tin',
                'Ten.unique'=>'Tên loại tin đã tồn tại',
                'Ten.min'=>'Ký tự phải có độ dài từ 3->100 ký tự.',
                'Ten.max'=>'Ký tự phải có độ dài từ 3->100 ký tự.',
                'TheLoai.required'=>'Bạn chưa chọn thể loại'
            ]);
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thành công!');

    }
    public function getXoa($id)
    {
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Bạn đã xóa thành công!');
    }
}

