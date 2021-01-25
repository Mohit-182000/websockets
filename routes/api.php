<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->namespace('api')->group(function () {

    Route::post('login', 'AuthApiController@login');
    Route::post('signup', 'AuthApiController@signup');

    Route::post('forgot/password', 'AuthApiController@forgotpassword');
    Route::post('reset/password', 'AuthApiController@resetpassword');

    Route::post('otp-send', 'AuthApiController@otpsend');
    Route::post('verify-otp', 'AuthApiController@otpVerify');

    //Route::post('forgotpassword', 'AuthApiController@changeForgotPassword');
   // Route::post('verify-otp-forgot-password', 'AuthApiController@verifyOtpForgotPassword');

    Route::middleware('auth:api')->group(function () {

        // Auth API Route's
        Route::post('change-password', 'AuthApiController@changePassword');
        Route::get('logout', 'AuthApiController@logout');
        Route::get('/profile', 'AuthApiController@getProfile');
        Route::post('/update-profile', 'AuthApiController@updateProfile');
        Route::post('/send-otp', 'AuthApiController@otpsend');
        Route::post('/otp-verify', 'AuthApiController@otpVerify');

        // Chat Route's
        Route::post('/user-send-message', 'ChatApiController@send_messages');

        // Category List
        Route::get('/get-category-list', 'JobPostController@getCategoryList');
        Route::get('/get-category-attribute/{id}', 'JobPostController@getCategoryAttribute');

        // JobPost API Route's
        Route::post('/store-job-post', 'JobPostController@storeJobPost');
        Route::get('/edit-job-post', 'JobPostController@editPostDetail');
        Route::get('/get-job-post-detail/{id}', 'JobPostController@jobPostDetail');
        Route::post('/update-job-post', 'JobPostController@updateJobPost');
        Route::get('/delete-job-post', 'JobPostController@deleteJobPostDetail');
        Route::get('/closed-job-post', 'JobPostController@closeJobPost');
        Route::get('/search-job', 'JobPostController@searchJob');
        Route::get('/view-more-job', 'JobPostController@viewMoreJob');

        // Job Seeker API Rout's
        Route::get('/get-job-seeker-home-page', 'JobSeekerApiController@JobSeekerHomePage');
        Route::get('/job-seeker-profile','JobSeekerApiController@profile');
        Route::get('/get-job-seeker-job','JobSeekerApiController@jobSeekerJob');
        Route::post('/job-seeker-job-apply', 'JobSeekerApiController@jobSeekerJobApply');

        Route::get('/remove-work-experience', 'JobSeekerApiController@deleteWorkExperience');
        Route::get('/remove-qualification', 'JobSeekerApiController@deleteQualification');

        Route::post('/update-job-seeker-profile-image','JobSeekerApiController@profileImageEdit');
        Route::post('/update-job-seeker-profile-salary','JobSeekerApiController@profileSalaryEdit');
        Route::post('/update-job-seeker-profile-basic-detail','JobSeekerApiController@profileBasicDetailEdit');
        Route::post('/update-job-seeker-profile-work-experience','JobSeekerApiController@profileWorkExperienceEdit');
        Route::post('/update-job-seeker-profile-qualification','JobSeekerApiController@profileQualificationEdit');
        Route::post('/update-job-seeker-profile-job-type','JobSeekerApiController@profileJobTypeEdit');
        Route::post('/update-job-seeker-profile-job-category','JobSeekerApiController@profileJobCategoryEdit');
        Route::post('/update-job-seeker-profile-skill','JobSeekerApiController@profileSkillEdit');
        Route::post('/update-job-seeker-profile-known-languages','JobSeekerApiController@profileKnownLanguagesEdit');
        Route::post('/update-job-seeker-profile-preferred-location','JobSeekerApiController@profilePreferredLocationEdit');

        Route::get('/generate-resume','JobSeekerApiController@generateResume');

        // Employer API Rout's
        
        Route::get('/get-employer-jobs', 'EmployerProfileApiController@employerJobs');
        
        Route::get('/get-employer-job-post-list', 'EmployerProfileApiController@employerJobPostList');
        Route::get('/get-matching-candidate', 'EmployerProfileApiController@matchingCandidateList');

        Route::get('/get-employer-job-seeker', 'EmployerProfileApiController@getEmployerJobSeeker');
        Route::get('/employer-home-page', 'EmployerProfileApiController@employerHomePage');
        Route::get('/employer-profile', 'EmployerProfileApiController@employerProfile');
        Route::post('/update-employer-profile', 'EmployerProfileApiController@updateEmployerProfile');
        Route::post('/update-user-language', 'EmployerProfileApiController@updateUserLanguage');
        Route::get('/delete-user-workspace-photo','EmployerProfileApiController@deleteUserWorkspacePhoto');
        Route::post('/category-user','EmployerProfileApiController@categoryUser');
        Route::post('/update-teacher-attribute','JobSeekerApiController@updateTeacherAttribute');
        Route::get('/get-company-autofill-detail-on-jobpost', 'EmployerProfileApiController@getCompanyAutofillDetailOnJobPost');
        Route::get('/get-employer-job-user-apply', 'EmployerProfileApiController@getEmployerJobUserApply');
        Route::post('/employer-shortlist-user','EmployerProfileApiController@employerShortlistUser');
        Route::get('/employer-job-seeker-detail','EmployerProfileApiController@employerJobSeekerDetail');
        Route::get('/employer-job-seeker-search','EmployerProfileApiController@employerJobSeekerSearch');
        Route::get('/view-more-candidate','EmployerProfileApiController@viewMoreCandidate');
        Route::post('/update-employer-preferences','EmployerProfileApiController@updateEmployerPreferences');
        // Route::post('/update-employer-category','EmployerProfileApiController@updateEmployerCategory');
        Route::get('/employer-workspace-photo','EmployerProfileApiController@employerWorkspacePhoto');
        Route::post('/store-employer-workspace-photo','EmployerProfileApiController@storeEmployerWorkspacePhoto');

        // Job Filter API Route's
        Route::post('/job-filter', 'JobPostController@getJobFilter');

        // Payment API Rout's
        Route::post('/store-payment', 'PaymentApiController@storePayment');

        // General Setting API
        Route::get('/general-setting', 'AuthApiController@generalSetting');

        // Salary Limit API
        Route::get('/salary-limit', 'AuthApiController@salaryLimit');
    });

});

// Auth Register Route's
Route::post('/register', 'Api\AuthApiController@signup');
Route::post('/send-otp', 'Api\AuthApiController@send_otp');
Route::post('/otp-verify', 'Api\AuthApiController@is_otp_verify');
Route::post('/login', 'Api\AuthApiController@login');
Route::post('/forget-password', 'Api\AuthApiController@forget_password');

// Open API Route's
Route::get('/get-qualification-list', 'api\JobPostController@getQualificationList');
Route::get('/get-experience-list', 'api\JobPostController@getExperience');
Route::get('/get-salary-list', 'api\JobPostController@getSalaryList');
Route::get('/get-languages-list', 'api\JobPostController@getLanguages');
Route::post('/get-skill-list', 'api\JobPostController@getSkill');
Route::get('/get-job-type-list', 'api\JobPostController@getJobType');
Route::get('/get-career-level-list', 'api\JobPostController@getCareerLevel');
Route::get('/get-functional-area-list', 'api\JobPostController@getFunctionalArea');
Route::get('/get-industries-list', 'api\JobPostController@getIndustries');
Route::get('/get-shift-list', 'api\JobPostController@getShift');
Route::get('/get-marital-status', 'api\JobPostController@getMaritalStatus');
Route::get('/get-state', 'api\JobPostController@getState');
Route::get('/get-city/{id}', 'api\JobPostController@getCity');
Route::get('/get-category-list/{id}', 'api\JobPostController@getCategory');
Route::get('/get-company-type-list', 'api\JobPostController@getCompanyType');
Route::get('/get-locality-list/{city_id}', 'api\JobPostController@getLocality');

//Package API Rout's
Route::get('/get-package-detail', 'api\PaymentApiController@getPackageDetail');

// Exam Update API Route's
Route::get('/get-exam-updates-list', 'api\ExamUpdateApiController@getExamUpdate');
Route::get('/get-exam-updates-detail/{id}', 'api\ExamUpdateApiController@getExamUpdateDetail');

// Knowledge Bank API Route's
Route::get('/get-knowledge-bank-list', 'api\KnowledgeBankApiController@getKnowledgeBank');
Route::get('/get-knowledge-bank-detail/{id}', 'api\KnowledgeBankApiController@getKnowledgeBankDetail');
