@extends('website.layout.app')
@section('title','Misssion & Vision')
@section('style')
<style type="text/css">
@media only screen and (min-width: 1281px){
.section-with-img-right .text-section {
    padding-left: 9% !important;
}
}

@media only screen and (min-width: 1281px){
.section-with-img-left .text-section {
    padding-right: 9% !important;
}
}
</style>
@section('content')
 <div id="content">

    	<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

	    <div class="breadcrumbs-wrap">

	      <div class="container">
	        
	        <h1 class="page-title">Misssion & Vision</h1>

	        <ul class="breadcrumbs">

	          <li><a href="{{ url('/') }}">Home</a></li>
	           <li>About LPIS</li><li>Misssion & Vision</li>

	        </ul>

	      </div>

	    </div>

	    <!-- - - - - - - - - - - - - end Breadcrumbs - - - - - - - - - - - - - - - -->

	    <!-- page-section -->

    	<!-- page section -->
		<div class="section-with-img-right page-section-bg fx-col-2">

			<div class="text-section">

    			<h3>Our Mission</h3>
    			<div class="text-wrap">
    				<p>Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipisMauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet. </p>
    				<p class="text-size-medium fw-medium">Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem. </p>
    				<p>Vestibulum sed ante. Donec sagittis euismod purus.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam ,eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
					</p>
    			</div>

    		</div>

    		<div class="img-section">
    			<img src="{{ asset('assets/website/images/975x483_img1.jpg') }}" alt="">
    		</div>
	        
	    </div>

	    <!-- page section -->
		<div class="section-with-img-left fx-col-2">

			<div class="img-section">
    			<img src="{{ asset('assets/website/images/975x483_img2.jpg') }}" alt="" align="right">
    		</div>

			<div class="text-section">

    			<h3>Our Vision</h3>
    			<div class="text-wrap">
    				<p>Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipisMauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet. </p>
    				<p class="text-size-medium fw-medium">Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem. </p>
    				<p>Vestibulum sed ante. Donec sagittis euismod purus.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam ,eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. 
					</p>
    			</div>

    		</div>
	        
	    </div>

    </div>

@endsection