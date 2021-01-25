@extends('website.layout.app')
@section('title','Gallery')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/website/plugins/fancybox/jquery.fancybox.css')}}">
<link rel="stylesheet" href="{{ asset('assets/website/plugins/fancybox/helpers/jquery.fancybox-buttons.css')}}">
<link rel="stylesheet" href="{{ asset('assets/website/plugins/fancybox/helpers/jquery.fancybox-thumbs.css')}}">
@endpush
@section('content')
 <div id="content">

    	<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

	    <div class="breadcrumbs-wrap">

	      <div class="container">
	        
	        <h1 class="page-title">Gallery</h1>

	        <ul class="breadcrumbs">

	          <li><a href="{{url('/')}}">Home</a></li>
	          <li>Gallery</li>

	        </ul>

	      </div>

	    </div>

	    <!-- - - - - - - - - - - - - end Breadcrumbs - - - - - - - - - - - - - - - -->

	    <!-- page-section -->

    	<div class="page-section">

    		<div class="container">

    			<!-- - - - - - - - - - - - - - Filter - - - - - - - - - - - - - - - - -->    	

    			<div id="options">
    				<div id="filters" class="isotope-nav">
    					<button class="is-checked" data-filter="*">All</button>
    					<button data-filter=".category_2">Meals</button>
    					<button data-filter=".category_3">Classes</button>
    					<button data-filter=".category_4">Leisure</button>
    				</div>
    			</div>

    			<!-- - - - - - - - - - - - - - End of Filter - - - - - - - - - - - - - - - - -->    	

    			<div class="isotope three-collumn clearfix portfolio-holder" data-isotope-options='{"itemSelector" : ".item","layoutMode" : "masonry","transitionDuration":"0.7s","masonry" : {"columnWidth":".item"}}'>
    				<div class="item category_2">
						
						<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img7.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img7.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_3">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img8.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img8.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_2">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img9.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img9.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_4">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img2.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img2.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_3">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img13.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img13.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_2">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img3.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img3.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_4">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img5.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img5.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_2">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img16.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img16.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_3">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img17.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img17.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_4">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img18.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img18.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_2">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img19.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img19.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>
    				<div class="item category_3">

    					<!-- - - - - - - - - - - - - - Project - - - - - - - - - - - - - - - - -->

    					<div class="project">

			                <!-- - - - - - - - - - - - - - Project Image - - - - - - - - - - - - - - - - -->

			                <div class="project-image">

			                	<img src="{{ asset('assets/website/images/360x220_img1.jpg')}}" alt="">
			                	<a href="{{ asset('assets/website/images/360x220_img1.jpg')}}" class="project-link project-action fancybox" title="Title 1" rel="category"></a>

			              	</div>

			              	<!-- - - - - - - - - - - - - - End of Project Image - - - - - - - - - - - - - - - - -->

			            </div>

			            <!-- - - - - - - - - - - - - - End of Project - - - - - - - - - - - - - - - - -->

    				</div>

    			</div>

    			<ul class="pagination">
    				<li>
    					<a href="#" class="prev-page"></a>
    				</li>
    				<li>
    					<a href="#">1</a>
    				</li>
    				<li>
    					<a href="#">2</a>
    				</li>
    				<li>
    					<a href="#">3</a>
    				</li>
    				<li>
    					<a href="#" class="next-page"></a>
    				</li>
    			</ul>

    		</div>

    	</div>

    </div>

@endsection
@push('js')
<script src="{{ asset('assets/website/plugins/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/website/plugins/fancybox/jquery.fancybox.pack.js') }}"></script>
<script src="{{ asset('assets/website/plugins/fancybox/helpers/jquery.fancybox-thumbs.js') }}"></script>
<script src="{{ asset('assets/website/plugins/fancybox/helpers/jquery.fancybox-buttons.js') }}"></script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
@endpush