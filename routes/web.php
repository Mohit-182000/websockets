<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/pdf','Admin\JobSeekerController@generateResume');
Route::post('/check-exist', 'CommonController@checkExist')->name('check.exist');
Route::post('/change-status/{id}', 'CommonController@changeStatus')->name('change-status');
Route::get('country', 'Controller@getCountry')->name('get.country');
Route::get('state', 'CommonController@getState')->name('get.state');
Route::get('marital-status', 'CommonController@getMaritalStatus')->name('get.marital-status');
Route::get('experience', 'CommonController@getExperience')->name('get.experience');
Route::get('skill', 'CommonController@getSkill')->name('get.skill');
Route::get('qualification', 'CommonController@getQualification')->name('get.qualification');
Route::get('known-languages', 'CommonController@getKnownLanguages')->name('get.known-languages');
Route::get('shift', 'CommonController@getShift')->name('get.shift');
Route::get('category', 'CommonController@getCategory')->name('get.category');
Route::get('company-type', 'CommonController@getCompanyType')->name('get.company-type');
Route::get('job-type', 'CommonController@getJobType')->name('get.job-type');
Route::get('industries', 'CommonController@getIndustries')->name('get.industries');
Route::get('city', 'Controller@getCity')->name('get.city');
Route::get('locality', 'Controller@getLocality')->name('get.locality');
Route::get('city-state', 'Controller@getCityFromState');
Route::get('role', 'Controller@getRole')->name('get.role');

Route::view('privacy-policy','admin.privacy_policy.index');

Route::get('/symbolic-link', function () {
  Artisan::call('storage:link');
  echo 'Link created successfully.';
});

Route::get('/db-migration', function () {
  Artisan::call('migrate');
  echo 'Migrated successfully.';
});

Route::get('/clear-cache', function () {
  Artisan::call('cache:clear');
  Artisan::call('config:clear');
  Artisan::call('route:clear');
  Artisan::call('view:clear');
  echo 'All clear done successfully.';
});

//- - - - - - - - - - - - - - - - -Common Controller Check exits - - - - - - - - - - - - - - - - - -//
Route::get('/', 'AdminAuth\LoginController@showLoginForm');
Route::get('/admin', 'AdminAuth\LoginController@showLoginForm');
Route::post('/check-exist', 'Controller@checkExist')->name('check.exist');

Route::group(['prefix' => 'admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/email/check', 'AdminAuth\LoginController@emailCheck');
  Route::get('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  // Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  // Route::post('/register', 'AdminAuth\RegisterController@register');

  // Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  // Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  // Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  // Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

  Route::resource('/permission','Admin\PermissionController');
  Route::resource('/role','Admin\RoleController');

  Route::get('user-job-apply','Admin\UserJobApplyController@index')->name('admin.user_job_apply-index');
  Route::post('user-job-apply-list/datalist', 'Admin\UserJobApplyController@dataList')->name('admin.user-job-apply.list');
  Route::get('/user-job-apply-view/{id}','Admin\UserJobApplyController@show')->name('admin.view_user_job_apply');
});

// Route::group(['prefix' => 'user'], function () {
//   Route::get('/login', 'UserAuth\LoginController@showLoginForm')->name('login');
//   Route::post('/login', 'UserAuth\LoginController@login');
//   Route::post('/logout', 'UserAuth\LoginController@logout')->name('logout');

//   Route::get('/register', 'UserAuth\RegisterController@showRegistrationForm')->name('register');
//   Route::post('/register', 'UserAuth\RegisterController@register');

//   Route::post('/password/email', 'UserAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
//   Route::post('/password/reset', 'UserAuth\ResetPasswordController@reset')->name('password.email');
//   Route::get('/password/reset', 'UserAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
//   Route::get('/password/reset/{token}', 'UserAuth\ResetPasswordController@showResetForm');
// });

