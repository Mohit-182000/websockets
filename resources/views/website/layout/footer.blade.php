<footer id="footer" class="footer">
		
		<!-- Top footer -->
		<div class="top-footer">
			
			<div class="container">
				
				<div class="icons-box fx-col-4">

					<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
					<div class="icons-wrap">

						<div class="icons-item">
							<div class="item-box"> <i class="licon-map-marker"></i>
								<h5 class="icons-box-title">
									<a href="javascript:void(0);">Address</a>
								</h5>
								<p>
									<!-- 9870 St Vincent Place, <br> Glasgow, DC 45 Fr 45 -->
									{{ $settings->address_name ?? ''}} <br>
									{{ $settings->city->name }} - {{ $settings->pincode }}<br>{{ $settings->state->name }} - {{ $settings->country->name }}
								</p>
							</div>
						</div>

					</div>
					<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
					<div class="icons-wrap">

						<div class="icons-item">
							<div class="item-box"><i class="licon-clock3"></i>
								<h5 class="icons-box-title">
									<a href="javascript:void(0);">Opening Hours</a>
								</h5>
								<p>
									Monday – Friday <br> 8:00 AM – 5:00 PM
								</p>
							</div>
						</div>

					</div>
					<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
					<div class="icons-wrap">

						<div class="icons-item">
							<div class="item-box"> <i class="licon-smartphone"></i>
								<h5 class="icons-box-title">
									<a href="javascript:void(0);">Contact Us</a>
								</h5>
								<p>
									+91 {{$settings->address_contact ?? ''}} <br> <a href="mailto:{{$settings->address_email}}" class="link-text">{{$settings->address_email ?? ''}}</a>
								</p>
							</div>
						</div>

					</div>
					<!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->				
					<div class="icons-wrap">
						@php
                                $social = json_decode($settings->social)
                                @endphp
						<div class="icons-item">
							<div class="item-box"> <i class="licon-share2"></i>
								<h5 class="icons-box-title">
									<a href="javascript:void(0);">Stay Connected</a>
								</h5>
								<ul class="social-icons style-2">
									@if($social->facebook!='')
					                <li class="fb-icon"><a href="{{ $social->facebook }}" target="_blank"><i class="icon-facebook"></i></a></li>
					                @endif
					                @if($social->youtube!='')
					                <li class="youtube-icon"><a href="{{$social->youtube}}" target="_blank"><i class="icon-youtube"></i></a></li>
					                @endif
					                @if($social->twitter!='')
					                <li class="tweet-icon"><a href="{{$social->twitter}}" target="_blank"><i class="icon-twitter"></i></a></li>
					                @endif
					                @if($social->instagram!='')
					                <li class="insta-icon"><a href="{{$social->instagram}}" target="_blank"><i class="icon-instagram-4"></i></a></li>
					                @endif

					               {{--  <li class="linkedin-icon"><a href="" target="_blank"><i class="icon-linkedin"></i></a></li>--}}

					            </ul>
							</div>
						</div>

					</div>

				</div>

			</div>

		</div>

		<!-- Copyright -->
		<div class="copyright-section">
			
			<div class="container">

				<ul class="hr-list">
					<li><a href="#">Home</a></li>
					<li><a href="#">About LPIS</a></li>
					<li><a href="#">Academics</a></li>
					<li><a href="#">Gallery</a></li>
					<li><a href="#">Admission</a></li>
					<li><a href="#">More</a></li>
					<li><a href="#">Fees Online</a></li>
					<li><a href="#">Contact</a></li>
				
				</ul>

				<p class="copyright">Copyright <span>Lokpriya Providentia International School</span> © {{date('Y')}}. All Rights Reserved</p>

			</div>

		</div>

    </footer>