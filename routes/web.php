<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/SanPham', function () {
	return 'Danh mục sản phẩm';
});
Route::get('/demo',function(){
    return 'Đây là demo đầu tiên';
});
Route::get('/demos',function(){
    echo "<h1>Đây là demo đầu tiên</h1>";
});
// Dinh danh
Route::get('Route1',['as'=>'MyRoute', function()
	{
		echo "Xin chao moi nguoi kaka";
	}
]);

Route::get('Laravel/{ngay}',function($ngay){
    echo "NGAY HNAY".$ngay;
})->where(['ngay'=>'[0-9]+']);
// bai goi controller
Route::get('GoiController', 'MyController@XinChao');
Route::get('ThamSo/{nd}', 'MyController@Truyen');
// URL
Route::get('MyRequest', 'MyController@GetURL');
// Gui nhan du lieu voi request
Route::get('getForm', function(){
	return view('postForm');
});
// 
Route::post('postForm',['as'=>'postForm', 'uses'=>'MyController@postForm']);
//set cookie
Route::get('setCookie','MyController@setCookie');
//get cookie
Route::get('getCookie','MyController@getCookie');

Route::get('uploadFile', function(){
	return view('postFile');
});
Route::post('postFile', ['as'=>'postFile', 'uses'=>'MyController@postFile']);
// Json
Route::get('getJson','MyController@getJson');

Route::get('myView','MyController@myView');
Route::get('Time/{t}','MyController@Time');
View::share('KhoaHoc', 'Laravell');
// phan trang
Route::get('blade',function(){
	return view('pages.php');
});
Route::get('BladeTemplate/{str}','MyController@blade');
//
Route::get('database',function()
	{
	// Schema::create('loaisanpham', function($table){
	// 	$table->increments('id');
	// 	$table->string('ten');

	// });

	
	Schema::create('loaisanpham1', function($table){
		$table->increments('id');
		$table->string('ten',200);
		

	});
	echo "Da tao bang!";

});
Route::get('lienketbang',function()
{
	Schema::create('sanpham',function($table){
		$table->increments('id');
		$table->string('ten', 200);
		$table->float('gia');
		$table->integer('soluong')->default(0);
		$table->integer('id_loaisanpham')->unsigned();
		$table->foreign('id_loaisanpham')->references('id')->on('loaisanpham');
	});
	echo "Da tao bang lien ket!";

});
Route::get('xoacot', function()
{
	Schema::table('loaisanpham', function($table){
		$table->dropColumn('id');

	});
});
Route::get('themcot', function()
{
	Schema::table('theloai', function($table){
		$table->string('new');

	});

});
// query builder
Route::get('qb/get', function(){
	$data = DB::table('users')->get();
	foreach($data as $row)
	{
		foreach($row as $key=>$value)
		{
			echo $key.":".$value."<br>";
		}
		echo "<hr>";
	}

});
// truy van
Route::get('qb/where', function(){
	$data = DB::table('users')->where('id','=',2)->get();
	foreach($data as $row)
	{
		foreach($row as $key=>$value)
		{
			echo $key.":".$value."<br>";
		}
		echo "<hr>";
	}

});
// truy van 3 dong
Route::get('qb/select', function(){
	$data = DB::table('users')->select(['id','name','email'])->where('id',2)->get();
	foreach($data as $row)
	{
		foreach($row as $key=>$value)
		{
			echo $key.":".$value."<br>";
		}
		echo "<hr>";
	}

});
// slect name as hoten from...
Route::get('qb/raw', function(){
	$data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id',2)->get();
	foreach($data as $row)
	{
		foreach($row as $key=>$value)
		{
			echo $key.":".$value."<br>";
		}
		echo "<hr>";
	}

});
// orderby
Route::get('qb/orderby', function(){
	$data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id','>',1)->orderBy('id','desc')->get();
	foreach($data as $row)
	{
		foreach($row as $key=>$value)
		{
			echo $key.":".$value."<br>";
		}
		echo "<hr>";
	}

});
// limit: skip take
Route::get('qb/skip', function(){
	$data = DB::table('users')->raw(DB::raw('id,name as hoten,email'))->where('id','>',1)->orderBy('id','desc')->skip(1)->take(2)->get();
	foreach($data as $row)
	{
		foreach($row as $key=>$value)
		{
			echo $key.":".$value."<br>";
		}
		echo "<hr>";
	}

});
// count
Route::get('qb/ChangeName', function(){
	$data = DB::table('users')->select(DB::raw('id,name as hoten,email'))->where('id','>',1)->orderBy('id','desc')->take(2);
	var_dump($data);
	echo $data->count();
	// foreach($data as $row)
	// {
	// 	foreach($row as $key=>$value)
	// 	{
	// 		echo $key.":".$value."<br>";
	// 	}
	// 	echo "<hr>";
	// }

});
// Route::get('model/sanpham/save', function(){
// 	$sanpham = new App\SanPham();
// 	$sanpham->ten = "Iphone 8";
// 	$sanpham->soluong = 100;
// 	$sanpham->save();

// 	echo "Save Successful!";
// });
// truyen ten san pham tren route
Route::get('model/sanpham/save/{ten}', function($ten){
	$sanpham = new App\SanPham();
	$sanpham->ten = $ten;
	$sanpham->soluong = 100;
	$sanpham->save();

	echo "Saved " .$ten ;
});
// DELETE
Route::get('model/sanpham/delete', function(){
	App\SanPham::destroy(1);


	echo " Deleted! " ;
});

Route::get('createColumn', function(){
	Schema::table('sanpham', function($table){
		$table->integer ('id_loaisanpham')->insigned();
	});
});
//
Route::get('lienket', function(){
	$data = App\SanPham::find(3)->loaisanpham1->toArray();
	var_dump($data);
});
//
Route::get('diem',function(){
	echo "You had enough score!";
})->middleware('MyMidle')->name('diem');
Route::get('loi',function(){
	echo "You had not enough score!";
})->name('loi');
Route::get('nhapdiem',function(){
	return view('nhapdiem');
})->name('nhapdiem');
//
