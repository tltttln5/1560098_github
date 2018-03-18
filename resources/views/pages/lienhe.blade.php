@extends('layout.index')
@section('content')
<!-- Page Content -->
<div class="container">

	@include('layout.slide')

    <div class="space20"></div>


    <div class="row main-left">
    @include('layout.menu')

        <div class="col-md-9">
            <div class="panel panel-default">            
            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
            		<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
            	</div>

            	<div class="panel-body">
            		<!-- item -->
                    <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>
				    
                    <div class="break"></div>
				   	<h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                    <p>147 Đường số 79, Tân Quy, Quận 7, Hồ Chí Minh</p>

                    <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                    <p> thuysinhsg@gmail.com </p>

                    <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                    <p> 01267136569 </p>



                    <br><br>
                    <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                    <div class="break"></div><br>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.923117958305!2d106.7055947148005!3d10.74040879234598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f9c6e00f9e7%3A0x22f56f8ddb88f0c3!2zMTQ3IMSQxrDhu51uZyBz4buRIDc5LCBUw6JuIFF1eSwgUXXhuq1uIDcsIEjhu5MgQ2jDrSBNaW5o!5e0!3m2!1svi!2s!4v1521358900807" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

				</div>
            </div>
    	</div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection