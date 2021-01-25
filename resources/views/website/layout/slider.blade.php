<div class="rev-slider-wrapper">

	    	<div id="rev-slider" class="rev-slider"  data-version="5.0">

	    		<ul>
	    			@if($slider->count() > 0 )
	    			@foreach($slider as $slide)
	    			<li data-transition="fade" class="align-center">

	    				<img src="{{$slide->banner_image ?? asset('storage/default/picture.png') }}" class="rev-slidebg" alt="">	    

	    				<!-- - - - - - - - - - - - - - Layer 1 - - - - - - - - - - - - - - - - -->	    

	    				<div class="tp-caption tp-resizeme scaption-white-text rs-parallaxlevel-1"
			              data-x="center"
			              data-y="top" data-voffset="180"
			              data-whitespace="nowrap"
			              data-frames='[{"delay":150,"speed":2000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[175%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
			              data-responsive_offset="on" 
			              data-elementdelay="0.05" >{{ $slide->title ?? ''}}
			            </div>

	    				<!-- - - - - - - - - - - - - - End of Layer 1 - - - - - - - - - - - - - - - - -->	    

	    				<!-- - - - - - - - - - - - - - Layer 2 - - - - - - - - - - - - - - - - -->	    

	    				<div class="tp-caption tp-resizeme scaption-white-medium rs-parallaxlevel-2"
			              data-x="center"
			              data-y="top" data-voffset="225"
			              
			              data-frames='[{"delay":450,"speed":2000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[175%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]' >
			              	{{  $slide->title_2 ?? '' }}
			             			            
			              		
			              		
		              		
			            </div>

	    				<!-- - - - - - - - - - - - - - End of Layer 2 - - - - - - - - - - - - - - - - -->	        	    

	    				<!-- - - - - - - - - - - - - - Layer 3 - - - - - - - - - - - - - - - - -->	{{--    @php

	    						if($slide->btn_position=='Left')
	    						  $a = 'left'; 
	    						elseif($slide->btn_position=='Center')
	    							  $a = 'center'; 
	    						elseif($slide->btn_position=='Right')
	    							  $a = 'right'; 
	    					    else 
	    					          $a = 'center'; 
	    					  


	    					@endphp
	    				@if($slide->btn_name!='')
	    				<div class="tp-caption tp-resizeme rs-parallaxlevel-3"
			              data-x="{{$a}}"
			              data-y="top" data-voffset="420"
			              data-whitespace="nowrap"
			              data-frames='[{"delay":750,"speed":2500,"frame":"0","from":"x:[-100%];z:0;rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"auto:auto;","ease":"Power2.easeInOut"},{"frame":"hover","speed":"300","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;"}]'>
			
			    			<a href="{{ $slide->btn_url ?? 'javascript:void(0);'}}" class="btn btn-big type-2 btn-style-7" target="@if($slide->btn_url!='') _blank @endif">{{$slide->btn_name ?? ''}}</a>
			    			<!-- <a href="#" class="btn btn-big">Enrol Now</a> -->
			    		</div>
			    		@endif --}}

	    				<!-- - - - - - - - - - - - - - End of Layer 3 - - - - - - - - - - - - - - - - --> 

	    			</li>
	    			@endforeach
	    			@endif

	    {{-- 		<li data-transition="fade" class="align-center">

	    				<img src="{{ asset('assets/website/images/1920x730_slide2.jpg')}}" class="rev-slidebg" alt="">	    

	    				<!-- - - - - - - - - - - - - - Layer 1 - - - - - - - - - - - - - - - - -->	    

	    				<div class="tp-caption tp-resizeme scaption-white-text rs-parallaxlevel-1"
			              data-x="center"
			              data-y="top" data-voffset="180"
			              data-whitespace="nowrap"
			              data-frames='[{"delay":150,"speed":2000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[175%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
			              data-responsive_offset="on" 
			              data-elementdelay="0.05" >Welcome to Lokpriya Providentia International School
			            </div>

	    				<!-- - - - - - - - - - - - - - End of Layer 1 - - - - - - - - - - - - - - - - -->	    

	    				<!-- - - - - - - - - - - - - - Layer 2 - - - - - - - - - - - - - - - - -->	    

	    				<div class="tp-caption tp-resizeme scaption-white-large rs-parallaxlevel-2"
			              data-x="center"
			              data-y="top" data-voffset="225"
			              data-frames='[{"delay":450,"speed":2000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[175%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
			              >A Pace to Explore Imaging and Learn
			            </div>

	    				<!-- - - - - - - - - - - - - - End of Layer 2 - - - - - - - - - - - - - - - - -->	        	    

	    				<!-- - - - - - - - - - - - - - Layer 3 - - - - - - - - - - - - - - - - -->	    

	    				<div class="tp-caption tp-resizeme rs-parallaxlevel-3"
			              data-x="center"
			              data-y="top" data-voffset="420"
			              data-whitespace="nowrap"
			              data-frames='[{"delay":550,"speed":2500,"frame":"0","from":"x:[-100%];z:0;rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"auto:auto;","ease":"Power2.easeInOut"},{"frame":"hover","speed":"300","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;"}]'>
			    			<a href="#" class="btn btn-big type-2 btn-style-7">Read More</a>
			    			<a href="#" class="btn btn-big">Enrol Now</a>
			    		</div>

	    				<!-- - - - - - - - - - - - - - End of Layer 3 - - - - - - - - - - - - - - - - --> 

	    			</li>

	    			<li data-transition="fade" class="align-center">

	    				<img src="{{ asset('assets/website/images/1920x730_slide3.jpg')}}" class="rev-slidebg" alt="">	    

	    				<!-- - - - - - - - - - - - - - Layer 1 - - - - - - - - - - - - - - - - -->	    

	    				<div class="tp-caption tp-resizeme scaption-white-text rs-parallaxlevel-1"
			              data-x="center"
			              data-y="top" data-voffset="180"
			              data-whitespace="nowrap"
			              data-frames='[{"delay":150,"speed":2000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[175%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
			              data-responsive_offset="on" 
			              data-elementdelay="0.05" >Welcome to  Lokpriya Providentia International School
			            </div>

	    				<!-- - - - - - - - - - - - - - End of Layer 1 - - - - - - - - - - - - - - - - -->	    

	    				<!-- - - - - - - - - - - - - - Layer 2 - - - - - - - - - - - - - - - - -->	    

	    				<div class="tp-caption tp-resizeme scaption-white-large rs-parallaxlevel-2"
			              data-x="center"
			              data-y="top" data-voffset="225"
			              data-frames='[{"delay":450,"speed":2000,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeOut"},{"delay":"wait","speed":1000,"frame":"999","to":"y:[175%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'
			              >Where Learning  is Serious Fun
			            </div>

	    				<!-- - - - - - - - - - - - - - End of Layer 2 - - - - - - - - - - - - - - - - -->	        	    

	    				<!-- - - - - - - - - - - - - - Layer 3 - - - - - - - - - - - - - - - - -->	    

	    				<div class="tp-caption tp-resizeme rs-parallaxlevel-3"
			              data-x="center"
			              data-y="top" data-voffset="420"
			              data-whitespace="nowrap"
			              data-frames='[{"delay":750,"speed":2500,"frame":"0","from":"x:[-100%];z:0;rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;skX:0;skY:0;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"auto:auto;","ease":"Power2.easeInOut"},{"frame":"hover","speed":"300","ease":"Power1.easeInOut","to":"o:1;rX:0;rY:0;rZ:0;z:0;"}]'>
			    			<a href="#" class="btn btn-big type-2 btn-style-7">Read More</a>
			    			<a href="#" class="btn btn-big">Enrol Now</a>
			    		</div>

	    				<!-- - - - - - - - - - - - - - End of Layer 3 - - - - - - - - - - - - - - - - --> 

	    			</li>--}}

	    		</ul>

	    	</div>

	    </div>