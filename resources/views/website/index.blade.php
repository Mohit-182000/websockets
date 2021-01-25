@extends('website.layout.app')
@section('title','Home')
@section('content')
<div id="content">

    	<!-- - - - - - - - - - - - - - Revolution Slider - - - - - - - - - - - - - - - - -->

	    @include('website.layout.slider')

	    <!-- - - - - - - - - - - - - - End of Slider - - - - - - - - - - - - - - - - -->

	    <div class="container">
	    	
	    	<!-- welcome area -->
	    	<div class="welcome-section overlap fx-col-3">
				
				<!-- welcome element -->
	    		<div class="welcome-col">
	    			
	    			<div class="welcome-item">

						<div class="welcome-inner">
							
							<div class="welcome-img">
	    						<img src="{{ asset('assets/website/images/360x220_img1.jpg')}}" alt="">
	    					</div>

	    					<div class="welcome-content">

	    						<svg class="bigHalfCircle" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
									<path d="M0 100 C40 0 60 0 100 100 Z"></path>
								</svg>
	    						
	    						<h4 class="welcome-title">Child Care</h4>
	    						<p>Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis.</p>
	    						<a href="#" class="btn type-2 btn-style-7">Read More</a>

	    						<span class="licon-baby-bottle"></span>

	    					</div>

						</div>

					</div>

	    		</div>
				
				<!-- welcome element -->
				<div class="welcome-col">
					
					<div class="welcome-item style-2">

						<div class="welcome-inner">
							
							<div class="welcome-img">
	    						<img src="{{ asset('assets/website/images/360x220_img2.jpg')}}" alt="">
	    					</div>

	    					<div class="welcome-content">

	    						<svg class="bigHalfCircle" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
									<path d="M0 100 C40 0 60 0 100 100 Z"></path>
								</svg>
	    						
	    						<h4 class="welcome-title">Healthy Meals</h4>
	    						<p>Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Auctor pulvinar. </p>
	    						<a href="#" class="btn type-2 btn-style-7">Read More</a>

	    						<span class="licon-platter"></span>

	    					</div>

						</div>

					</div>

				</div>
				
				<!-- welcome element -->
				<div class="welcome-col">
					
					<div class="welcome-item style-3">

						<div class="welcome-inner">
							
							<div class="welcome-img">
	    						<img src="{{ asset('assets/website/images/360x220_img3.jpg')}}" alt="">
	    					</div>

	    					<div class="welcome-content">

	    						<svg class="bigHalfCircle" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
									<path d="M0 100 C40 0 60 0 100 100 Z"></path>
								</svg>
	    						
	    						<h4 class="welcome-title">Active Learning</h4>
	    						<p>Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam.</p>
	    						<a href="#" class="btn type-2 btn-style-7">Read More</a>

	    						<span class="licon-graduation-hat"></span>

	    					</div>

						</div>

					</div>

				</div>

	    	</div>

	    </div>
		
		<!-- page-section -->

    	<div class="page-section">
    		
    		<div class="container">
    			
    			<div class="row">
    				<div class="col-md-8">
    					
    					<div class="content-element2">
    						
    						<div class="title-holder">
    							
    							<h2 class="section-title">Welcome to <br>
                                Lokpriya Providentia International School</h2>
		    					<p>Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. </p>
		    					<a href="#" class="info-btn">More About Us</a>
		    					
    						</div>

    					</div>

    					<div class="content-element2">
    						
    						<div class="row">
    							<div class="col-sm-6">
    								
    								<!-- banner -->
    								<a href="#" class="banner-item">
					                  <div class="banner-inner">
					                  	<i class="licon-tie"></i>
					                    <h5 class="banner-title">Employment <br> Vacancies</h5>
					                    <p>Nulla venenatis. In pede mi, aliquet sit amet, euismod.</p>
					                    <div class="btn btn-small">View Vacancies</div>
					                  </div>
					                </a>

    							</div>
    							<div class="col-sm-6">
    								
    								<!-- banner -->
    								<a href="#" class="banner-item">
					                  <div class="banner-inner">
					                  	<i class="licon-question"></i>
					                    <h5 class="banner-title">Did you know?</h5>
					                    <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere.</p>
					                    <div class="btn btn-small">Find Out More</div>
					                  </div>
					                </a>

    							</div>
    						</div>

    					</div>

    				</div>
    				<div class="col-md-4">
    					
    					<h3>Upcoming Events</h3>
    					<ul class="news-list">
                
		                    <li>
		                    	
		                    	<article class="entry">

									<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->

									<div class="entry-body">

										<!-- - - - - - - - - - - - - - Entry Meta - - - - - - - - - - - - - - - - -->

										<div class="entry-meta">

											<time class="entry-date" datetime="2016-01-27">Tue Dec 20</time>

										</div>

										<!-- - - - - - - - - - - - - - End of Meta - - - - - - - - - - - - - - - - -->

										<h5 class="entry-title"><a href="#">Christmas Picnic</a></h5>

										<div class="contact-info-menu">

				            				<div class="contact-info-item">
				            					<i class="icon-clock"></i>
				            					<span>12:00 AM - 5:00 PM</span>
				            				</div>
				            				<div class="contact-info-item">
				            					<i class="icon-location"></i>
				            					<span>1, NEW JAMNAGAR, OPP. SWAMINARAYAN TEMPLE, AIRPORT ROAD, JAMNAGAR - 361006, GUJARAT (INDIA).</span>
				            				</div>

				            			</div>

									</div>

									<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

								</article>

		                    </li>
		                    <li>
		                    	
		                    	<article class="entry">

									<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->

									<div class="entry-body">

										<!-- - - - - - - - - - - - - - Entry Meta - - - - - - - - - - - - - - - - -->

										<div class="entry-meta">

											<time class="entry-date" datetime="2016-01-27">Fri Jan 12</time>

										</div>

										<!-- - - - - - - - - - - - - - End of Meta - - - - - - - - - - - - - - - - -->

										<h5 class="entry-title"><a href="#">Annual Open Day</a></h5>

										<div class="contact-info-menu">

				            				<div class="contact-info-item">
				            					<i class="icon-clock"></i>
				            					<span>4:00 PM</span>
				            				</div>
				            				<div class="contact-info-item">
				            					<i class="icon-location"></i>
				            					<span>1, NEW JAMNAGAR, OPP. SWAMINARAYAN TEMPLE, AIRPORT ROAD, JAMNAGAR - 361006, GUJARAT (INDIA).</span>
				            				</div>

				            			</div>

									</div>

									<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

								</article>

		                    </li>
		                    <li>
		                    	
		                    	<article class="entry">

									<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->

									<div class="entry-body">

										<!-- - - - - - - - - - - - - - Entry Meta - - - - - - - - - - - - - - - - -->

										<div class="entry-meta">

											<time class="entry-date" datetime="2016-01-27">MON FEB 17</time>

										</div>

										<!-- - - - - - - - - - - - - - End of Meta - - - - - - - - - - - - - - - - -->

										<h5 class="entry-title"><a href="#">Children’s Book Week</a></h5>

										<div class="contact-info-menu">

				            				<div class="contact-info-item">
				            					<i class="icon-clock"></i>
				            					<span>All day</span>
				            				</div>
				            				<div class="contact-info-item">
				            					<i class="icon-location"></i>
				            					<span>1, NEW JAMNAGAR, OPP. SWAMINARAYAN TEMPLE, AIRPORT ROAD, JAMNAGAR - 361006, GUJARAT (INDIA).</span>
				            				</div>

				            			</div>

									</div>

									<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

								</article>

		                    </li>

		                </ul>
		                <a href="#" class="info-btn">More Events</a>

    				</div>
    			</div>

    		</div>

    	</div>

    	<div class="holder-bg type-2 parallax-section" data-bg="{{ asset('assets/website/images/2122x1000_bg.jpg')}}">

			<div class="container">

				<div class="title-holder align-center">
					
					<h2 class="section-title">Our Curriculum</h2>
					<p>Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum <br> auctor pulvinar. Vestibulum iaculis lacinia est. </p>

				</div>
				
				<div class="icons-box fx-col-3">

					<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
					<div class="icons-wrap">

						<div class="icons-item">
							<div class="item-box"> <i class="licon-earth"></i>
								<h5 class="icons-box-title">
									<a href="#">Foreign Languages</a>
								</h5>
								<p>
									Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel.
								</p>
							</div>
						</div>

					</div>
					<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
					<div class="icons-wrap">

						<div class="icons-item">
							<div class="item-box"><i class="licon-music-note3"></i>
								<h5 class="icons-box-title">
									<a href="#">Music Programs</a>
								</h5>
								<p>
									Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel.
								</p>
							</div>
						</div>

					</div>
					<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
					<div class="icons-wrap">

						<div class="icons-item">
							<div class="item-box"> <i class="licon-spotlights"></i>
								<h5 class="icons-box-title">
									<a href="#">Dance Class</a>
								</h5>
								<p>
									Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel.
								</p>
							</div>
						</div>

					</div>
					<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
					<div class="icons-wrap">

						<div class="icons-item">
							<div class="item-box"> <i class="licon-brush"></i>
								<h5 class="icons-box-title">
									<a href="#">Art Classes</a>
								</h5>
								<p>
									Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum.
								</p>
							</div>
						</div>

					</div>
					<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
					<div class="icons-wrap">

						<div class="icons-item">
							<div class="item-box"><i class="licon-tennis"></i>
								<h5 class="icons-box-title">
									<a href="#">Sports Programs</a>
								</h5>
								<p>
									Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget.
								</p>
							</div>
						</div>

					</div>
					<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
					<div class="icons-wrap">

						<div class="icons-item">
							<div class="item-box"> <i class="licon-theater"></i>
								<h5 class="icons-box-title">
									<a href="#">Gifted & Talented Program</a>
								</h5>
								<p>
									Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget.
								</p>
							</div>
						</div>

					</div>

				</div>

			</div>

		</div>

				<div class="section-with-carousel">

	        <div class="row">

	        	<div class="col-md-6">

	        		<div class="img-holder">
	        			<img src="{{ asset('assets/website/images/985x661_img.jpg') }}" alt="" align="right">
	        		</div>

	        	</div>
	        	<div class="col-md-6">

	        		<div class="testimonial-section align-center">

	        			<h2 class="section-title">What Parents Say</h2>

	        			<!-- - - - - - - - - - - - - Owl-Carousel - - - - - - - - - - - - - - - -->

			          	<div class="carousel-type-1">

				          	<div class="owl-carousel" data-max-items="1" data-autoplay="true">

				          		<!-- Slide -->				          
				          		<div class="item-carousel">
				          			<!-- Carousel Item -->				          
				          			<div class="testimonial type-2">

				          				<div class="author-box">

				          					<a href="#" class="avatar"><img src="{{ asset('assets/website/images/200x200_author1.jpg') }}" alt=""></a>

				          				</div>

				          				<div class="testimonial-holder">
				          					<blockquote>
				          						<p>
				          							“Donec eget tellus non erat lacinia fermentum. Donec in <br> velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia <br> est. Proin dictum elementum velit.”
				          						</p>
				          					</blockquote>
				          				</div>

				          				<div class="author-box">

				          					<div class="author-info">

				          						<span class="author-name">Amanda Johnson</span>

				          					</div>

				          				</div>

				          			</div>
				          			<!-- /Carousel Item --> 
				          		</div>
				          		<!-- /Slide -->				          

				          		<!-- Slide -->				          
				          		<div class="item-carousel">
				          			<!-- Carousel Item -->				          
				          			<div class="testimonial type-2">

				          				<div class="author-box">

				          					<a href="#" class="avatar"><img src="{{ asset('assets/website/images/200x200_author1.jpg')}}" alt=""></a>

				          				</div>

				          				<div class="testimonial-holder">
				          					<blockquote>
				          						<p>
				          							“Donec eget tellus non erat lacinia fermentum. Donec in <br> velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia <br> est. Proin dictum elementum velit.”
				          						</p>
				          					</blockquote>
				          				</div>

				          				<div class="author-box">

				          					<div class="author-info">

				          						<span class="author-name">Amanda Johnson</span>

				          					</div>

				          				</div>

				          			</div>
				          			<!-- /Carousel Item --> 
				          		</div>
				          		<!-- /Slide -->

				          		<!-- Slide -->				          
				          		<div class="item-carousel">
				          			<!-- Carousel Item -->				          
				          			<div class="testimonial type-2">

				          				<div class="author-box">

				          					<a href="#" class="avatar"><img src="{{ asset('assets/website/images/200x200_author1.jpg')}}" alt=""></a>

				          				</div>

				          				<div class="testimonial-holder">
				          					<blockquote>
				          						<p>
				          							“Donec eget tellus non erat lacinia fermentum. Donec in <br> velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia <br> est. Proin dictum elementum velit.”
				          						</p>
				          					</blockquote>
				          				</div>

				          				<div class="author-box">

				          					<div class="author-info">

				          						<span class="author-name">Amanda Johnson</span>

				          					</div>

				          				</div>

				          			</div>
				          			<!-- /Carousel Item --> 
				          		</div>
				          		<!-- /Slide -->	

				          	</div>

				        </div>

	        		</div>

	        	</div>
	        </div>
	        
	    </div>

	    <div class="holder-bg counters-section with-pattern">

			<div class="container">
				
				<div class="row table-row">
					<div class="col-md-4">
						
						<h6 class="section-pre-title">parents choose us</h6>
						<h2 class="section-title">Why LPIS ?</h2>

					</div>
					<div class="col-md-8">
						
						<div class="row">

							<div class="col-md-3 col-xs-6">

								<div class="counter">
									<div class="counter-inner">
										<h3 class="timer count-number" data-to="12" data-speed="1500">0</h3>
										<p>Years of Experience</p>
									</div>
								</div>

							</div>
							<div class="col-md-3 col-xs-6">

								<div class="counter">
									<div class="counter-inner">
										<h3 class="timer count-number" data-to="35" data-speed="1500">0</h3>
										<p>Qualified Teachers</p>
									</div>
								</div>

							</div>
							<div class="col-md-3 col-xs-6">

								<div class="counter">
									<div class="counter-inner">
										<h3 class="timer count-number" data-to="847" data-speed="1500">0</h3>
										<p>Happy Children</p>
									</div>
								</div>

							</div>
							<div class="col-md-3 col-xs-6">

								<div class="counter">
									<div class="counter-inner">
										<h3 class="timer count-number" data-to="95" data-speed="1500">0</h3>
										<p>Total Activities</p>
									</div>
								</div>

							</div>

						</div>

					</div>
				</div>

			</div>

		</div>

		<div class="call-out type-2">
							
			<div class="container">
				
				<div class="row table-row">
					<div class="col-sm-8">
						
						<h2>Enrol Your Child For 2020-2021</h2>
						<p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. </p>

					</div>
					<div class="col-sm-4">
						
						<div class="align-right">
			                <div class="button-holder">
			                  <a href="#" class="btn btn-big">Enrol Now!</a>
			                  <p>Or Call <span>855-605-8080</span></p>
			                </div>
			            </div>

					</div>
				</div>

			</div>

		</div>

		<div class="page-section-bg align-center">
			
			<div class="container">

				<h2 class="section-title type2">Latest News</h2>
				
				<!-- welcome area -->
		    	<div class="welcome-section blog-type fx-col-3">
					
					<!-- welcome element -->
		    		<div class="welcome-col">
		    			
		    			<div class="welcome-item">

							<div class="welcome-inner">
								
								<div class="welcome-img">
		    						<img src="{{ asset('assets/website/images/360x220_img4.jpg')}}" alt="">
		    						<time class="entry-date" datetime="2016-08-20">
		    							<span>20</span>aug
		    						</time>
		    					</div>

		    					<div class="welcome-content">

		    						<svg class="bigHalfCircle" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
										<path d="M0 100 C40 0 60 0 100 100 Z"></path>
									</svg>
		    						
		    						<div class="entry">

										<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->

										<div class="entry-body">

											<h5 class="entry-title"><a href="#">Vestibulum Ante Ipsum</a></h5>

											<p>Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. </p>

										</div>

										<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Entry meta - - - - - - - - - - - - - - - - -->

										<div class="entry-meta">

											<div class="entry-byline"><a href="#">Admin</a></div>
											<a href="#" class="entry-news">News</a>
											<a href="#" class="entry-comments-link">3</a>

										</div>

										<!-- - - - - - - - - - - - - - Entry meta - - - - - - - - - - - - - - - - -->

									</div>

		    					</div>

							</div>

						</div>

		    		</div>
					
					<!-- welcome element -->
		    		<div class="welcome-col">
		    			
		    			<div class="welcome-item">

							<div class="welcome-inner">
								
								<div class="welcome-img">
		    						<img src="{{ asset('assets/website/images/360x220_img5.jpg')}}" alt="">
		    						<time class="entry-date" datetime="2016-08-17">
		    							<span>17</span>aug
		    						</time>
		    					</div>

		    					<div class="welcome-content">

		    						<svg class="bigHalfCircle" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
										<path d="M0 100 C40 0 60 0 100 100 Z"></path>
									</svg>
		    						
		    						<div class="entry">

										<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->

										<div class="entry-body">

											<h5 class="entry-title"><a href="#">Donec Eget Tellus</a></h5>

											<p>Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem. </p>

										</div>

										<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Entry meta - - - - - - - - - - - - - - - - -->

										<div class="entry-meta">

											<div class="entry-byline"><a href="#">Admin</a></div>
											<a href="#" class="entry-news">Announcements</a>
											<a href="#" class="entry-comments-link">0</a>

										</div>

										<!-- - - - - - - - - - - - - - Entry meta - - - - - - - - - - - - - - - - -->

									</div>

		    					</div>

							</div>

						</div>

		    		</div>

		    		<!-- welcome element -->
		    		<div class="welcome-col">
		    			
		    			<div class="welcome-item">

							<div class="welcome-inner">
								
								<div class="welcome-img">
		    						<img src="{{ asset('assets/website/images/360x220_img6.jpg')}}" alt="">
		    						<time class="entry-date" datetime="2016-08-10">
		    							<span>10</span>aug
		    						</time>
		    					</div>

		    					<div class="welcome-content">

		    						<svg class="bigHalfCircle" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 100 100" preserveAspectRatio="none">
										<path d="M0 100 C40 0 60 0 100 100 Z"></path>
									</svg>
		    						
		    						<div class="entry">

										<!-- - - - - - - - - - - - - - Entry body - - - - - - - - - - - - - - - - -->

										<div class="entry-body">

											<h5 class="entry-title"><a href="#">Nulla Venenatis</a></h5>

											<p>Vestibulum sed ante. Donec sagittis euismod purus.Sed ut perspiciatis sit voluptatem accusantium.</p>

										</div>

										<!-- - - - - - - - - - - - - - End of Entry body - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Entry meta - - - - - - - - - - - - - - - - -->

										<div class="entry-meta">

											<div class="entry-byline"><a href="#">Admin</a></div>
											<a href="#" class="entry-news">News</a>
											<a href="#" class="entry-comments-link">7</a>

										</div>

										<!-- - - - - - - - - - - - - - Entry meta - - - - - - - - - - - - - - - - -->

									</div>

		    					</div>

							</div>

						</div>

		    		</div>

		    	</div>

		    	<a href="#" class="btn type-2 btn-style-6">More News</a>

			</div>

		</div>

    </div>
@endsection