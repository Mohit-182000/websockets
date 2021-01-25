<header id="header" class="header">
        
        <!-- search-form -->
        <div class="searchform-wrap">
            <div class="vc-child h-inherit relative">

              <form>
                <input type="text" name="search" placeholder="Start typing...">
                <button type="button"></button>
              </form>

            </div>
            <button class="close-search-form"></button>
        </div>

        <!-- top-header -->
        <div class="top-header">
            
            <!-- - - - - - - - - - - - / Mobile Menu - - - - - - - - - - - - - -->

            <!--main menu-->

            <div class="menu-holder">
                
                <div class="menu-wrap">

                    <div class="table-row">
                        
                        <!-- logo -->

                        <div class="logo-wrap">

                            <a href="" class="logo"><img src="{{ asset('assets/website/images/logo.png')}}" alt=""></a>

                        </div>

                        <!-- Menu & TopBar -->
                        <div class="nav-item">
                            
                            <!-- Top Bar -->
                            
                            <div class="contact-info-menu">

                                <div class="contact-info-item">
                                    <i class="icon-phone"></i>
                                    <a href="tel:{{$settings->address_contact}}">+91 {{ $settings->address_contact ?? ''}}</a>
                                </div>
                                <div class="contact-info-item">
                                    <i class="icon-mail-1"></i>
                                    <a href="mailto:{{$settings->address_email}}">{{ $settings->address_email ?? ''}}</a>
                                </div>
                                <!-- <div class="contact-info-item">
                                    <i class="icon-location"></i>
                                    <span>1, NEW JAMNAGAR, OPP. SWAMINARAYAN TEMPLE, AIRPORT ROAD, JAMNAGAR - 361006, GUJARAT (INDIA).</span>
                                </div> -->
                                <!-- <div class="contact-info-item lang-button">
                                    <i class="icon-globe-1"></i>
                                    <a href="#">English</a>
                                    <ul class="dropdown-list">
                                        <li><a href="#">English</a></li>
                                        <li><a href="#">German</a></li>
                                        <li><a href="#">Spanish</a></li>
                                    </ul>
                                </div>
                                <div class="contact-info-item">
                                    <i class="icon-globe-1"></i>
                                    <a href="#">Client/Register</a>
                                </div> -->
                                @php
                                $social = json_decode($settings->social)
                                @endphp


                        
                                <div class="contact-info-item">
                                    <ul class="social-icons">
                                        @if($social->facebook!='')
                                        <li class="fb-icon"><a href="{{ $social->facebook }}" target="_blank"><i class="icon-facebook"></i></a></li>
                                        @endif
                                       
                                        @if($social->youtube!='')
                                        <li class="youtube-icon"><a href="{{$social->youtube}}" target="_blank"><i class="icon-youtube-2"></i></a></li>
                                        @endif
                                        @if($social->twitter!='')
                                        <li class="tweet-icon"><a href="{{$social->twitter}}" target="_blank"><i class="icon-twitter"></i></a></li>
                                        @endif
                                        @if($social->instagram!='')
                                        <li class="insta-icon"><a href="{{$social->instagram}}" target="_blank"><i class="icon-instagram-4"></i></a></li>
                                        @endif
                                      {{--   @if($social->linkedin!='')
                                        <li class="linkedin-icon"><a href="{{$social->linkedin}}" target="_blank"><i class="icon-linkedin-2"></i></a></li>
                                        @endif--}}


                                    </ul>
                                </div>

                            </div>
                            
                            <!-- - - - - - - - - - - - - - Navigation - - - - - - - - - - - - - - - - -->

                            <nav id="main-navigation" class="main-navigation">
                                <ul id="menu" class="clearfix">
                                    <li class="{{ (request()->is('/')) ? 'current' : '' }}"><a href="{{ url('/')}}">Home</a>
                                        <!--sub menu-->
                                     
                                    </li>
                                    <li class="dropdown"><a href="#">About LPIS</a>
                                        <!--sub menu-->
                                        <div class="sub-menu-wrap">
                                            <ul>
                                                <li><a href="{{ route('mission-vision') }}">Mission & Vision</a></li>
                                                <li><a href="{{ route('about-school') }}">About School</a></li>
                                                <li><a href="{{ route('about-lokpriya-foundataion') }}">About Lokpriya Foundation</a></li>
                                                <li><a href="{{ route('chairperson-message') }}">ChairPerson Message</a></li>
                                                <li><a href="{{ route('principal-message') }}">Principal Message</a></li>
                                                <li><a href="{{ route('beyond-academics') }}">Beyond Academics</a></li>
                                              
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="dropdown"><a href="#">Academics</a>
                                        <!--sub menu-->
                                        <div class="sub-menu-wrap">
                                            <ul>
                                                <li><a href="#">Curriculum </a></li>
                                                <li><a href="#">Academics Pre Primary</a></li>
                                                <li><a href="#">Academics Primary</a></li>
                                                <li><a href="#">Academics Middle School</a></li>
                                                <li><a href="#">Academics Secondary</a></li>
                                                <li><a href="#">News , Event , Important Notification</a></li>
                                                
                                            
                                            </ul>
                                        </div>
                                    </li>
                                    <li class=""><a href="{{ route('gallery') }}">Gallery</a>
                                     
                                    </li>
                                    <li class="dropdown"><a href="#">Admission</a>
                                        <!--sub menu-->
                                        <div class="sub-menu-wrap">
                                            <ul>
                                                <li><a href="#">Procedure</a></li>
                                                <li><a href="#">Fee Structure</a></li>
                                                <li><a href="#">Forms</a></li>
                                                <li><a href="#">School Brochure</a></li>
                                                
                                            
                                            </ul>
                                        </div>
                                    </li>
                                     <li class="dropdown"><a href="#">More</a>
                                        <!--sub menu-->
                                        <div class="sub-menu-wrap">
                                            <ul>
                                                <li><a href="#">Annual Calendar</a></li>
                                                <li><a href="#">Rules & Regulations</a></li>
                                                <li><a href="#">TCS Upload</a></li>
                                                <li><a href="#">Mandatory Disclosure</a></li>
                                                
                                            
                                            </ul>
                                        </div>
                                    </li>
                                  
                                    <li class=""><a href="#">Fees Online</a></li>
                                    <li class="{{ (request()->is('contact')) ? 'current' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
                                    
                                    
                                </ul>
                            </nav>

                            <!-- - - - - - - - - - - - - end Navigation - - - - - - - - - - - - - - - -->

                           <!--  <div class="search-holder">

                                <button class="search-button"></button>

                            </div> -->

                            <a href="{{ route('inquiry.index')}}" class="btn btn-style-2">Inquire</a>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        
        <!-- bottom-separator -->
        <div class="bottom-separator"></div>
      
    </header>