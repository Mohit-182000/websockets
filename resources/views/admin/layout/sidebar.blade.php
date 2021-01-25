<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ $setting->logo_image ?? null }}" alt="News Portal Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ str_limit($settings->store_name, 20) ?? ''}}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ $adminlogin->profile_image }}" alt="" id="sidebarimage" class="img-circle elevation-2">
      </div>
      <div class="info">
        <a href="#" class="d-block">Welcome.</a>
      </div>
    </div> --}}
    <!-- Sidebar Menu -->

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard')}}"
                       class="nav-link @if(Request::fullUrl() === route('admin.dashboard')) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                 <li class="nav-item">
                    <a href="{{route('admin.job_seeker-index')}}" class="nav-link {{ isActive(['job_seeker-index','job_seeker-view']) }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p> Job Seeker</p>
                    </a>
                </li>

                {{-- Employer Management --}}

                 <li class="nav-item">
                    <a href="{{route('admin.employer-index')}}" class="nav-link {{ isActive(['employer-index','employer-view']) }}">
                        <i class="nav-icon fas fa-id-card"></i>
                        <p> {{__('sidebar.employer')}}</p>
                    </a>
                </li>

                {{-- Job Post --}}

                 <li class="nav-item">
                      <a href="{{route('admin.job_post')}}" class="nav-link  {{ isActive(['job_post','view_job_post']) }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p> {{__('sidebar.job_post')}}</p>
                    </a>
                </li>

                {{-- Knowledge Bank --}}

                 <li class="nav-item">
                    <a href="{{route('admin.knowledge-bank.index')}}" class="nav-link {{ isActive(['knowledge-bank.*']) }}">
                        <i class="nav-icon fas fa-university"></i>
                        <p> {{__('sidebar.knowledge_bank')}}</p>
                    </a>
                </li>

                {{-- Exam Updates --}}

                 <li class="nav-item">
                    <a href="{{route('admin.exam-updates.index')}}" class="nav-link {{ isActive(['exam-updates.*']) }}">
                        <i class="nav-icon fa fa-book"></i>
                        <p> {{__('sidebar.exam_updates')}}</p>
                    </a>
                </li>

                {{-- Chat --}}

                 <li class="nav-item">
                    <a href="{{ route('admin.chat.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p> {{__('sidebar.chat')}}</p>
                    </a>
                </li>

                {{-- Payment --}}

                <li class="nav-item">
                    <a href="{{ route('admin.package.index') }}" class="nav-link {{ isActive(['package.*']) }}">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p> {{__('sidebar.package')}}</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.payment.index') }}" class="nav-link {{ isActive(['payment.*']) }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p> {{__('sidebar.payment')}}</p>
                    </a>
                </li>

                {{-- User Management --}}

                 <li class="nav-item">
                    <a href="{{route('admin.user.index')}}" class="nav-link  {{ isActive(['user.*']) }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p> {{__('sidebar.user')}}</p>
                    </a>
                </li>

                 {{-- Start - Master --}}

                <li class="nav-item has-treeview {{ isActive([
                                                    'category.*',
                                                    'qualification.*',
                                                    'experience.*',
                                                    'known-languages.*',
                                                    'skills.*',
                                                    'job-type.*',
                                                    'career-levels.*',
                                                    'functional-area.*',
                                                    'industries.*',
                                                    'company-type.*',
                                                    'locality.*',
                                                    'marital-status.*',
                                                    'state.*',
                                                    'city.*',
                                                    'salary.*',
                                                    'shifts.*'] ,'menu-open') }}">
                    <a href="#" class="nav-link {{ isActive([
                                                    'category.*',
                                                    'qualification.*',
                                                    'experience.*',
                                                    'known-languages.*',
                                                    'skills.*',
                                                    'job-type.*',
                                                    'career-levels.*',
                                                    'functional-area.*',
                                                    'industries.*',
                                                    'company-type.*',
                                                    'locality.*',
                                                    'marital-status.*',
                                                    'state.*',
                                                    'city.*',
                                                    'salary.*',
                                                    'shifts.*']) }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"> </i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        {{-- Start - Category --}}

                            <li class="nav-item">
                                <a href="{{route('admin.category.index')}}" class="nav-link {{ isActive(['category.*']) }}"><i class="fas fa-angle-right"></i> {{__('sidebar.category')}}</a>
                            </li>

                        {{-- End - Category --}}

                        {{-- Start -Industries    --}}

                            <li class="nav-item">
                                <a href="{{route('admin.industries.index')}}" class="nav-link {{ isActive(['industries.*']) }} "><i class="fas fa-angle-right"></i> {{__('sidebar.industries')}}</a>
                            </li>

                        {{-- End -Industries   --}}

                        {{-- Start - Career Levels   --}}

                            {{-- <li class="nav-item">
                                <a href="{{route('admin.career-levels.index')}}" class="nav-link  {{ isActive(['career-levels.*']) }}"><i class="fas fa-angle-right"></i> {{__('sidebar.career_levels')}}</a>
                            </li> --}}

                        {{-- End - Career Levels  --}}

                        {{-- Start - Known Languages   --}}

                            <li class="nav-item">
                                <a href="{{route('admin.known-languages.index')}}" class="nav-link {{ isActive(['known-languages.*']) }} "><i class="fas fa-angle-right"></i> {{__('sidebar.known_languages')}}</a>
                            </li>

                        {{-- End - Known Languages  --}}

                        {{-- Start -Shifts     --}}

                            <li class="nav-item">
                                <a href="{{route('admin.shifts.index')}}" class="nav-link {{ isActive(['shifts.*']) }} "><i class="fas fa-angle-right"></i> {{__('sidebar.shifts')}}</a>
                            </li>

                        {{-- End -Shifts    --}}

                        {{-- Start - Marital Status     --}}

                            <li class="nav-item">
                                <a href="{{route('admin.marital-status.index')}}" class="nav-link {{ isActive(['marital-status.*']) }} "><i class="fas fa-angle-right"></i> {{__('sidebar.marital_status')}}</a>
                            </li>

                        {{-- End - Marital Status    --}}

                        {{-- Start - State    --}}

                            <li class="nav-item">
                                <a href="{{route('admin.state.index')}}" class="nav-link {{ isActive(['state.*']) }} "><i class="fas fa-angle-right"></i> {{__('sidebar.state')}}</a>
                            </li>

                        {{-- End - State   --}}

                        {{-- Start - City    --}}

                            <li class="nav-item">
                                <a href="{{route('admin.city.index')}}" class="nav-link {{ isActive(['city.*']) }} "><i class="fas fa-angle-right"></i> {{__('sidebar.city')}}</a>
                            </li>

                        {{-- End - City   --}}

                        {{-- Start - Experience   --}}

                            <li class="nav-item">
                                <a href="{{route('admin.experience.index')}}" class="nav-link {{ isActive(['experience.*']) }} "><i class="fas fa-angle-right"></i> {{__('sidebar.experience')}}</a>
                            </li>

                        {{-- End - Experience  --}}

                        {{-- Start - Qualification  --}}

                            <li class="nav-item">
                                <a href="{{route('admin.qualification.index')}}" class="nav-link {{ isActive(['qualification.*']) }} "><i class="fas fa-angle-right"></i> {{__('sidebar.qualification')}}</a>
                            </li>

                        {{-- End - Qualification --}}

                        {{-- Start -Functional Area   --}}

                            {{-- <li class="nav-item">
                                <a href="{{route('admin.functional-area.index')}}" class="nav-link "><i class="fas fa-angle-right"></i> {{__('sidebar.functional_area')}}</a>
                            </li> --}}

                        {{-- End -Functional Area  --}}

                        {{-- Start - Job Type   --}}

                            <li class="nav-item">
                                <a href="{{route('admin.job-type.index')}}" class="nav-link {{ isActive(['job-type.*']) }} "><i class="fas fa-angle-right"></i> {{__('sidebar.job_type')}}</a>
                            </li>

                        {{-- End - Job Type  --}}

                        {{-- Start - Skills   --}}

                            <li class="nav-item">
                                <a href="{{route('admin.skills.index')}}" class="nav-link {{ isActive(['skills.*']) }} "><i class="fas fa-angle-right"></i> {{__('sidebar.skills')}}</a>
                            </li>

                        {{-- End - Skills  --}}

                        {{-- Start - Company Type   --}}

                            <li class="nav-item">
                                <a href="{{route('admin.company-type.index')}}" class="nav-link {{ isActive(['company-type.*']) }} ">
                                    <i class="fas fa-angle-right"></i>
                                    Company Type
                                </a>
                            </li>

                        {{-- End - Company Type   --}}

                        {{-- Start - Locality   --}}

                            <li class="nav-item">
                                <a href="{{route('admin.locality.index')}}" class="nav-link {{ isActive(['locality.*']) }} ">
                                    <i class="fas fa-angle-right"></i>
                                    Locality
                                </a>
                            </li>

                        {{-- End - Locality   --}}

                        <li class="nav-item">
                            <a href="{{route('admin.salary.index')}}" class="nav-link {{ isActive(['salary.*']) }} ">
                                <i class="fas fa-angle-right"></i>
                                Salary
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- End - Master --}}



                <li class="nav-item has-treeview {{ isActive([
                        'settings.*','languages.*',
                        'roles.*','users.*','taxes.*','homepagebanners.*','units.*','series.*','paymentsettings.*','banner.*','mailsetup.*','city.*','term.*'] ,'menu-open') }} ">
                    <a href="#"
                       class="nav-link {{ isActive(['settings.*','homepagebanners.*','roles.*','users.*','taxes.*','units.*','languages.*','translations.*','series.*','paymentsettings.*','banner.*','mailsetup.*','city.*','term.*']) }}">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item ">
                            <a href="{{ route('admin.homepagebanners.index') }}" class="nav-link {{ isActive(['homepagebanners.*']) }}">
                                <i class="fas fa-tag nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.settings.index') }}"
                                class="nav-link @if(Request::fullUrl() === route('admin.settings.index')) active @endif">
                                <i class="fas fa-cog nav-icon"></i>
                                <p>General Setting</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('admin.mailsetup.index') }}"
                                class="nav-link @if(Request::fullUrl() === route('admin.mailsetup.index')) active @endif">
                                <i class="fas fa-envelope nav-icon"></i>
                                <p>Mail Setup</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
