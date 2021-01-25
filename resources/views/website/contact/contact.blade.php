@extends('website.layout.app')
@section('title','Conatct Us')
@section('content')
 <div id="content">

    	<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

	    <div class="breadcrumbs-wrap">

	      <div class="container">
	        
	        <h1 class="page-title">Contact Us</h1>

	        <ul class="breadcrumbs">

	          <li><a href="{{url('/')}}">Home</a></li>
	          <li>Contact Us</li>

	        </ul>

	      </div>

	    </div>

	    <!-- - - - - - - - - - - - - end Breadcrumbs - - - - - - - - - - - - - - - -->

	    <!-- page-section -->

    	<div class="page-section">

    		<div class="container">
    			
    			<div class="content-element2">
    				
    				<!-- Google map -->
    				<!-- <div id="googleMap" class="map-container"></div> -->
    				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3687.299858659107!2d70.01614871443189!3d22.45536334292383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395715958049b803%3A0xfab7ddb732e24fb9!2sLokpriya%20Providentia%20International%20School!5e0!3m2!1sen!2sin!4v1595055000962!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    			</div>

    			<div class="content-element2">
    				
    				<div class="row">
    					<div class="col-sm-4">

    						<h3>Contact Info</h3>
    						
    						<div class="icons-box style-2">

								<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
								<div class="icons-wrap">

									<div class="icons-item">
										<div class="item-box"> <i class="licon-map-marker"></i>
											<h5 class="icons-box-title">
												<a href="#">Address</a>
											</h5>
											<p>
												{{ $settings->address_name ?? ''}}<br>
												{{ $settings->city->name }} - {{ $settings->pincode }}<br>{{ $settings->state->name }} - {{ $settings->country->name }}
											</p>
										</div>
									</div>

								</div>
								<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
								<div class="icons-wrap">

									<div class="icons-item">
										<div class="item-box"> <i class="licon-telephone"></i>
											<h5 class="icons-box-title">
												<a href="#">Phone</a>
											</h5>
											<p>
												+91 {{$settings->address_contact ?? ''}}

											</p>
										</div>
									</div>

								</div>
								<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
								
								<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
								<div class="icons-wrap">

									<div class="icons-item">
										<div class="item-box"> <i class="licon-at-sign"></i>
											<h5 class="icons-box-title">
												<a href="#">Email</a>
											</h5>
											<p>
												<a href="mailto:{{$settings->address_email ?? ''}}" class="link-text">{{$settings->address_email ?? ''}}</a>
											</p>
										</div>
									</div>

								</div>
								<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
							{{-- 	<div class="icons-wrap">

									<div class="icons-item">
										<div class="item-box"><i class="licon-clock3"></i>
											<h5 class="icons-box-title">
												<a href="#">Opening Hours</a>
											</h5>
											<p>
												Monday – Friday <br> 8:00 AM – 5:00 PM
											</p>
										</div>
									</div>

								</div>--}}
								<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
								

							</div>

    					</div>
    					<div class="col-sm-8">
    						
    						<h3>We Would Love To Hear From You!</h3>
    						<p>If you have any questions, please call us or fill in the form below and we will get back to you very soon.</p>
    						<form action="{{ route('conatct-store') }}" method="post" id="conatctForm" class="contact-form flex-type" >
    							@csrf
    							<div class="contact-col-2"><input type="text" name="name" id="name" placeholder="Your Name (required)" maxlength="90" required></div>

    							<div class="contact-col-2"><input type="email" name="email" id="email" placeholder="Email (required)" maxlength="90" required></div>

    							<div class="contact-col-2"><input type="text" name="mobile" id="mobile" placeholder="Mobile (required)" maxlength="10" pattern="[7-9]{1}[0-9]{9}" title="Enter valid number digits with 10" required></div>

    							<div class="contact-col-2"><input type="text" name="subject" id="subject" placeholder="Subject"></div>
    							
    							

    							<div class="contact-col"><textarea rows="8" name="message" id="message" placeholder="Message"></textarea></div>

    							<div class="contact-col-submit">
    								<button type="submit" class="btn">Submit</button>
    							</div>

				            </form>

    					</div>
    				</div>

    			</div>

    		</div>

    	</div>

    </div>

@endsection