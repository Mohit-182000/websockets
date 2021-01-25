@extends('website.layout.app')
@section('title','About School')
@section('content')
 <div id="content">

    	<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

	    <div class="breadcrumbs-wrap">

	      <div class="container">
	        
	        <h1 class="page-title">Beyond Academics</h1>

	        <ul class="breadcrumbs">

	          <li><a href="{{ route('about-school') }}">Home</a></li>
	          <li>About LPIS</li><li>Beyond Academics</li>

	        </ul>

	      </div>

	    </div>

	    <!-- - - - - - - - - - - - - end Breadcrumbs - - - - - - - - - - - - - - - -->

	    <!-- page-section -->
	    
		<div class="page-section">
			
			<div class="container">
				
				<div class="row">
    				<div class="col-md-6">
    					
    					<img src="http://velikorodnov.com/html/owlhouse/images/555x365_img.jpg" alt="">

    				</div>
    				<div class="col-md-6">
    					
    					<h3>Welcome to SuperOwl <br> School of Early Learning</h3>
    					<p class="text-size-medium">Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. </p>
    					<!-- signature -->
    					<div class="signature">
    						<img src="images/signa.png" alt="">	    					
    						<span>Principal and Owner</span>
    					</div>

    				</div>
    			</div>

			</div>

		</div>

    	

    </div>

@endsection