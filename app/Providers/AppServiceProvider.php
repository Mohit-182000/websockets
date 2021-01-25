<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Mailsetup;
use App\Model\Setting;
use App\Model\Homepagebanner;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Config;
use Auth;
use View;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ini_set('max_execution_time', 18000);
        ini_set('memory_limit', '512M');
        
        View::composer('admin.*', function ($view) {

            if (Auth::guard('admin')->check()) {

                $user = Auth::guard('admin')->user();
                $view->with('setting', Setting::where('id', 1)->first());
                $view->with('adminlogin', $user);
            }

        });

        $settings = Setting::where('id', 1)->first();
        $slider = Homepagebanner::where('is_active', 'Yes')->get();
       
        view()->share('settings', $settings);
        view()->share('slider', $slider);
    }
}
