<?php

//------------------------------Admin Route-----------------------------------------------//

// use Illuminate\Routing\Route;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::namespace('Admin')->group(function () {

    //Dashboard
    Route::resource('dashboard', 'HomeController');
    Route::get('dashboard', 'HomeController@index')->name('dashboard');
    Route::get('job-applied-chart', 'HomeController@jobAppliedChart');
    Route::get('profile-creation-chart', 'HomeController@profileCreationChart');
    Route::get('shortlist-chart', 'HomeController@shortlisted');

    Route::get('chat','ChatController@index')->name('chat.index');
    Route::get('/user/list', 'ChatController@user_list');
    Route::get('/user/auth_user_data', 'ChatController@auth_user_data');
    Route::get('/user/get_receiver_user/{id}', 'ChatController@get_receiver_user');

    Route::get('/user/chat_list/{sender_id}/{receiver_id}','ChatController@user_chat_list');
    Route::post('/user/send_messages', 'ChatController@send_messages');

    Route::get('chat','ChatController@index')->name('chat.index');
    Route::get('/user/list', 'ChatController@user_list');
    Route::get('/user/auth_user_data', 'ChatController@auth_user_data');

    Route::get('/user/chat_list/{sender_id}/{receiver_id}','ChatController@user_chat_list');
    Route::post('/user/send_messages', 'ChatController@send_messages');

    //Profile and Change Password
    Route::get('/profile-overview', 'ProfileController@overviewIndex')->name('overview.index');
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::get('/profile-change-password', 'ProfileController@changepasswordIndex')->name('change-password.index');

    Route::post('/profile/change', 'ProfileController@profileChange')->name('profile.change');
    Route::post('/password/change', 'ProfileController@passwordChange')->name('password.change');
    Route::post('/change/image/{id}', 'ProfileController@changeProfilImage')->name('changeProfilImage');

    //-----------------------NEWS Images---------------------------//
    Route::post('news/{news_id}/image/alt', 'NewsImageController@changeAlt')->name('news.image.alt');
    Route::post('news/{news_id}/image/removeimage', 'NewsImageController@removeImage')->name('news.image.remove');
    Route::post('news/{news_id}/image/update', 'NewsImageController@positionImage')->name('news.image.position');

    Route::get('news/{news_id}/image', 'NewsImageController@Imageindex')->name('image.index');

    Route::get('reporter-news/{news_id}/image', 'NewsImageController@RepoaterImageindex')->name('repoater-news.image.index');
    Route::post('news/{news_id}/image/store', 'NewsImageController@store')->name('image.store');
});

Route::namespace('Admin')->group(function () {

    Route::get('swap/{id}', 'HomeController@swapBranch')->name('swap');

    Route::post('bannder/list', 'HomepagebannerController@dataListing')->name('homepagebanners.list');
    Route::post('bannder/status', 'HomepagebannerController@changeStatus')->name('homepagebanners.status');
    Route::resource('homepagebanners', 'HomepagebannerController');

    //- - - - - - - - - - - -Conatct us- - - - - - - -- - - - - - //
    Route::post('contactus/data-list', 'ContactUsController@dataList')->name('contactus.datalist');
    Route::resource('contactus', 'ContactUsController');

    //- - - - - - - - - - - - About LPIS - - - - - - - -- - - - - - //
    Route::post('about/data-list', 'AboutusController@dataList')->name('about.datalist');
    Route::resource('about', 'AboutusController');

    //- - - - - - - - - - - -Inquiry- - - - - - - -- - - - - - //
    Route::post('inquiry/data-list', 'InquiryController@dataList')->name('inquiry.datalist');
    Route::resource('inquiry', 'InquiryController');

    Route::group(['prefix' => 'setting'], function () {

        Route::get('users/exist', 'UserController@exists')->name('users.exist');
        Route::post('users/status/{id}', 'UserController@changeStatus')->name('users.status');
        Route::post('users/data-list', 'UserController@dataList')->name('users.datalist');
        Route::resource('users', 'UserController');

        Route::get('city/exist', 'CityController@exists')->name('city.exist');
        Route::post('city/status/{id}', 'CityController@changeStatus')->name('city.status');
        Route::post('city/data-list', 'CityController@dataList')->name('city.datalist');
        Route::resource('city', 'CityController');
        Route::get('term-condition', 'SettingController@termindex')->name('term.index');
        Route::post('term-condition/store', 'SettingController@termstore')->name('term.store');

        // Route::resource('privacy-policy', 'PrivacyPolicyController');
    });
        Route::resource('mailsetup', 'MailsetupController');
        Route::resource('settings', 'SettingController');


    // Start - Master

    //Category
    Route::post('category/datalist', 'CategoryController@dataList')->name('category.list');
    Route::post('category/status/{id}', 'CategoryController@changeStatus')->name('category.status');
    Route::resource('category', 'CategoryController');

    //Qualification
    Route::post('qualification/datalist', 'QualificationController@dataList')->name('qualification.list');
    Route::post('qualification/status/{id}', 'QualificationController@changeStatus')->name('qualification.status');
    Route::resource('qualification', 'QualificationController');

    //Experience
    Route::post('experience/datalist', 'ExperienceController@dataList')->name('experience.list');
    Route::post('experience/status/{id}', 'ExperienceController@changeStatus')->name('experience.status');
    Route::resource('experience', 'ExperienceController');

    //Known Languages
    Route::post('known-languages/datalist', 'KnownLanguagesController@dataList')->name('known-languages.list');
    Route::post('known-languages/status/{id}', 'KnownLanguagesController@changeStatus')->name('known-languages.status');
    Route::resource('known-languages', 'KnownLanguagesController');

    //Package Controller
    Route::resource('package', 'PackageController');
    Route::post('package/datalist', 'PackageController@dataList')->name('package.list');

    // Payment Controller
    Route::resource('payment', 'PaymentController');
    Route::post('payment/datalist', 'PaymentController@dataList')->name('payment.list');

    //Skills
    Route::post('skills/datalist', 'SkillsController@dataList')->name('skills.list');
    Route::post('skills/status/{id}', 'SkillsController@changeStatus')->name('skills.status');
    Route::resource('skills', 'SkillsController');

    //Job Type
    Route::post('job-type/datalist', 'JobtypeController@dataList')->name('job-type.list');
    Route::post('job-type/status/{id}', 'JobtypeController@changeStatus')->name('job-type.status');
    Route::resource('job-type', 'JobtypeController');

    //Career Levels
    Route::post('career-levels/datalist', 'CareerLevelsController@dataList')->name('career-levels.list');
    Route::post('career-levels/status/{id}', 'CareerLevelsController@changeStatus')->name('career-levels.status');
    Route::resource('career-levels', 'CareerLevelsController');

    //Functional Area
    Route::post('functional-area/datalist', 'FunctionalAreaController@dataList')->name('functional-area.list');
    Route::post('functional-area/status/{id}', 'FunctionalAreaController@changeStatus')->name('functional-area.status');
    Route::resource('functional-area', 'FunctionalAreaController');

    //Industries
    Route::post('industries/datalist', 'IndustriesController@dataList')->name('industries.list');
    Route::post('industries/status/{id}', 'IndustriesController@changeStatus')->name('industries.status');
    Route::resource('industries', 'IndustriesController');

    //Company Type
    Route::post('company-type/datalist', 'CompanyTypeController@dataList')->name('company-type.list');
    Route::post('company-type/status/{id}', 'CompanyTypeController@changeStatus')->name('company-type.status');
    Route::resource('company-type', 'CompanyTypeController');

    // Locality
    Route::post('locality/datalist', 'LocalityController@dataList')->name('locality.list');
    Route::resource('locality', 'LocalityController');

    Route::post('salary/datalist', 'SalaryController@dataList')->name('salary.list');
    Route::resource('salary', 'SalaryController');

    //Shifts
    Route::post('shifts/datalist', 'ShiftsController@dataList')->name('shifts.list');
    Route::post('shifts/status/{id}', 'ShiftsController@changeStatus')->name('shifts.status');
    Route::resource('shifts', 'ShiftsController');

    //Marital Status
    Route::post('marital-status/datalist', 'MaritalStatusController@dataList')->name('marital-status.list');
    Route::post('marital-status/status/{id}', 'MaritalStatusController@changeStatus')->name('marital-status.status');
    Route::resource('marital-status', 'MaritalStatusController');

    //State
    Route::post('state/datalist', 'StateController@dataList')->name('state.list');
    Route::post('state/status/{id}', 'StateController@changeStatus')->name('state.status');
    Route::resource('state', 'StateController');

    //City
    Route::post('city/datalist', 'CityController@dataList')->name('city.list');
    Route::post('city/status/{id}', 'CityController@changeStatus')->name('city.status');
    Route::resource('city', 'CityController');

    //Location
    Route::view('/location-index', 'admin.location.index')->name('location-index');
    Route::get('/location-create', function () {
        return response()->json(['html' =>  view('admin.location.create')->render()]);
    })->name('location-create');


    // End - Master

    //User Management
    Route::post('user/datalist', 'UserController@dataList')->name('user.list');
    Route::post('user/status/{id}', 'UserController@changeStatus')->name('user.status');
    Route::resource('user', 'UserController');

    Route::get('/employer-create', function () {
        return response()->json(['html' =>  view('admin.employer.create')->render()]);
    })->name('employer-create');

    //Knowledge Bank
    Route::post('knowledge-bank/datalist', 'KnowledgeBankController@dataList')->name('knowledge-bank.list');
    Route::post('knowledge-bank/status/{id}', 'KnowledgeBankController@changeStatus')->name('knowledge-bank.status');
    Route::resource('knowledge-bank', 'KnowledgeBankController');

    Route::get('/job-post','JobPostController@index')->name('job_post');
    Route::get('/job-post/{id}','JobPostController@show')->name('view_job_post');
    Route::post('/job-post/job-post-user-datalist/{id}', 'JobPostController@jobPostUser')->name('job-post-user.list');
    Route::get('/job-post-status/{id}','JobPostController@changeStatus')->name('change_job_status');
    Route::post('/update_job_status','JobPostController@updateStatus')->name('update_status');
    Route::get('/job-post/{id}/edit', 'JobPostController@edit')->name('job_post-edit');
    Route::post('/job-post/update','JobPostController@update')->name('job_post.update');

    //Employer
    Route::get('/employer', 'EmployerController@index')->name('employer-index');
    Route::get('/employer/{id}', 'EmployerController@show')->name('employer-view');
    Route::get('/employer/{id}/edit', 'EmployerController@edit')->name('employer-edit');
    Route::post('/employer/datalist', 'EmployerController@dataList')->name('employer.list');
    Route::post('/employer/job-post-datalist/{id}', 'EmployerController@employerJobPost')->name('employer-job-post.list');
    Route::post('/employer/employer-job-user-apply/{id}', 'EmployerController@employerJobUserApply')->name('employer-job-user-apply.list');
    Route::post('/workspace_image_delete','EmployerController@workSpaceImage');
    Route::post('/employer/update','EmployerController@update')->name('employer.update');

    //Job Seeker
    Route::get('/job-seeker', 'JobSeekerController@index')->name('job_seeker-index');
    Route::get('/job-seeker/{id}', 'JobSeekerController@show')->name('job_seeker-view');
    Route::post('/job_seeker/datalist', 'JobSeekerController@dataList')->name('job_seeker.list');
    Route::post('/job_seeker/user-job-datalist/{id}', 'JobSeekerController@userJobApplyList')->name('user-job.list');

    //Exam Updates
    Route::post('exam-updates/datalist', 'ExamUpdatesController@dataList')->name('exam-updates.list');
    Route::post('exam-updates/status/{id}', 'ExamUpdatesController@changeStatus')->name('exam-updates.status');
    Route::resource('exam-updates', 'ExamUpdatesController');


    //Job Post
    Route::view('/job_post-index', 'admin.job_post.index')->name('job_post-index');
    Route::view('/job_post-view', 'admin.job_post.view')->name('job_post-view');
    Route::post('job-post/datalist', 'JobPostController@dataList')->name('job-post.list');

    //Role & Permision
    Route::post('role-permission/datalist', 'RolePermissionController@dataList')->name('role-permission.list');
    Route::post('role-permission/status/{id}', 'RolePermissionController@changeStatus')->name('role-permission.status');
    Route::resource('role-permission', 'RolePermissionController');

});