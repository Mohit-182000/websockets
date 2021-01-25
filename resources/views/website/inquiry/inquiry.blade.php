@extends('website.layout.app')
@section('title','Inquiry')
@section('content')
 <div id="content">

    	<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

	    <div class="breadcrumbs-wrap">

	      <div class="container">
	        
	        <h1 class="page-title">Inquiry</h1>

	        <ul class="breadcrumbs">

	          <li><a href="{{url('/')}}">Home</a></li>
	   
	          <li>Inquiry</li>

	        </ul>

	      </div>

	    </div>

	    <!-- - - - - - - - - - - - - end Breadcrumbs - - - - - - - - - - - - - - - -->

	    <!-- page-section -->

    	<div class="page-section">

    		<div class="container">
    			
    			

    			<div class="content-element2">
    				
    				<div class="row">
    					
    					<div class="col-sm-12">
    						
    						<!-- <h3 style="text-align: center;">Admission Inquiry</h3> -->
    						<!-- <p>If you have any questions, please call us or fill in the form below and we will get back to you very soon.</p> -->
    						<form action="{{ route('inquiry.store') }}" method="post" id="inquiryForm" class="contact-form flex-type" name="inquiryForm">
    							@csrf
    							<div class="contact-col-2"><input type="text" name="parent_name" id="parent_name" placeholder="NAME OF PARENT (required)" maxlength="90" required></div>

    							<div class="contact-col-2"><input type="text" name="child_name" id="child_name" placeholder="CHILD'S NAME (required)" maxlength="90" required></div>

    							<div class="contact-col-2"><input type="text" name="dob" id="dob" placeholder="CHILD'S AGE / DOB: (required)" maxlength="20" required></div>

    							<div class="contact-col-2"><input type="text" name="mobile" id="mobile" placeholder="CONTACT NO (required)" maxlength="10" pattern="[7-9]{1}[0-9]{9}" title="Enter valid number digits with 10" required></div>
    							<div class="contact-col-2"><input type="email" name="email" id="email" placeholder="E-MAIL ADDRESS (required)" maxlength="90" required></div>


    							
    							

    							<div class="contact-col"><textarea rows="8" name="message" id="message" placeholder="PLEASE MENTION YOUR QUERY "></textarea></div>

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