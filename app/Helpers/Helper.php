<?php

use App\Model\Cart;
use App\Model\Category;
use App\Model\Language;
use App\Model\Package;
use App\Model\Series;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// if (!function_exists('date_format_list')) {

//     function date_format_list()
//     {
//         return [
//            'DD-MM-YYYY' => 'd-m-Y',
//            'YYYY-MM-DD' => 'YY-m-d',
//            'MM-DD-YYYY' => 'm-d-Y',
//         ];
//     }

// }
if (!function_exists('date_format_list')) {

    function date_format_list()
    {
        return [
           'DD-MM-YYYY' => 'd-m-Y',
           'YYYY-MM-DD' => 'YY-m-d',
           'MM-DD-YYYY' => 'm-d-Y',
        ];
    }

}

if (!function_exists('humanTiming')) {

    function humanTiming($start_time,$end_time)
    {
        $start = null;
        $end = time();

        if($start_time != null){
            $start = strtotime($start_time);
        }

        if($end_time != null){
            $end = strtotime($end_time);
        }

        $time = $end - $start;
        $time = ($time < 1) ? 1 : $time;
        $tokens = array(
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
        }
    }

}

if(!function_exists('dateformat')){

    function dateformat($date , $format=null ) {

        $setting = Cache::remember('default_setting',600 ,function () { 
            return \DB::table('settings')->first(); 
        });
       
        $date =  Carbon::parse($date)->format($format??$setting->site_date_format);

        return $date;


    }
    
}

if (!function_exists('transaction_no')) {

    function transaction_no($number)
    {
        return str_pad($number, 8, "0", STR_PAD_LEFT);
    }

}

if (!function_exists('inventoryType')) {

    function inventoryType($key = null)
    {

        $type = [
            'PO' => 'Production',
            'DI' => 'Disposed / Wastage',
            'CO' => 'Consumed for Production',
            'TL' => 'Transfer between locations',
        ];

        if (!is_null($key)) {
            return $type[$key];
        }
        return $type;
    }

}

if (!function_exists('generateUniqueSlug')) {

    function generateUniqueSlug($model, $stringForSlug, $id = 0, $slugColumn = "slug")
    {

        $slug = Str::slug($stringForSlug);

        $allSlugs = getRelatedSlugs($slug, $model, $id, $slugColumn);

        if (!$allSlugs->contains($slugColumn, $slug)) {
            return $slug;
        }

        $i = 1;
        do {
            $newSlug = $slug . '-' . $i;
            $i++;
        } while ($allSlugs->contains($slugColumn, $newSlug));

        $slug = $newSlug;

        $allSlugs = getRelatedSlugs($slug, $model, $id, $slugColumn);
        if (!$allSlugs->contains($slugColumn, $slug)) {
            return $slug;
        }
        return generateUniqueSlug($model, $slug, $id, $slugColumn);
    }
}

if (!function_exists('getRelatedSlugs')) {

    function getRelatedSlugs($slug, $model, $id, $slugColumn)
    {

        return $model->select($slugColumn)->where($slugColumn, 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }
}

if (!function_exists('numberFormateRoundHelper')) {

    function numberFormateRoundHelper($number, $desimal = 2)
    {

        if (is_null($number)) {
            return null;
        }
        $english_format_number = number_format($number, 2, '.', '');
        return $english_format_number;

    }
}

if (!function_exists('showShoppingCartCount')) {

    function showShoppingCartCount()
    {

        if (Auth::guard('contact')->check()) {
            $customer_id = Auth::guard('contact')->user()->id;
        } else {
            $customer_id = 0;
        }

        $device = Session::get('sessionIDs');
        $cartCount = Cart::when(Auth::guard('contact')->check(), function ($query) {
            $query->where('carts.contact_id', Auth::guard('contact')->user()->id);
        }, function ($query) {
            $query->where('carts.session_id', Session::get('sessionIDs'))->where('contact_id', null);
        })->count();

        return $cartCount;

    }

}

if (!function_exists('pagesMenuCategorys')) {

    function pagesMenuCategorys()
    {
        $leng = Language::defaltLanguage()->first();

        $categories = Category::categoryByLangue($leng)
            ->where('parent_id', null)
            ->where('is_active', 'Yes')
            ->orderBy('name', 'ASC')
            ->take(5)
            ->get();

        return $categories;

    }

}

if (!function_exists('uploadImage')) {

    function uploadImage($image, $dir, $unlink = null)
    {
        $request = request();

        if ($request->hasFile($image)) {
            $file = $request->file($image);
            $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $path = $file->storeAs($dir, $fileName);
            if ($unlink) {
                Storage::delete($unlink);
            }
            return $path;
        }

        return $unlink ? $unlink : NULL;

    }
}

if (!function_exists('employerUploadImage')) {

    function employerUploadImage($image, $dir, $unlink = null)
    {
        $request = request();

        if ($request->hasFile($image)) {
            $file = $request->file($image);
            $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $path = $file->storeAs($dir, $fileName);
            if ($unlink) {
                Storage::delete($unlink);
            }
            return $fileName;
        }

        return $unlink ? $unlink : NULL;

    }
}

if (!function_exists('deliverychallan_no')) {

    function deliverychallan_no($increment = true )
    {
        return getSeriesNumber(4 , $increment);
    }
}

if (!function_exists('inwardchallan_no')) {

    function inwardchallan_no($increment = true)
    {
        return getSeriesNumber(6 ,$increment);
    }

}

if (!function_exists('transferorder_no')) {

    function transferorder_no($increment = true)
    {
        return getSeriesNumber(2 ,$increment);
    }

}

if (!function_exists('inventory_no')) {

    function inventory_no($increment = true)
    {
        return getSeriesNumber(1 ,$increment);
    }

}

if (!function_exists('getSeriesNumber')) {

    function getSeriesNumber($id , $increment = false )
    {

        $setting = Series::findOrfail($id);
        $setting->next_number = $setting->next_number + 1;
        if($increment) {
            $setting->save();
        }


        $inv = transaction_no($setting->next_number);

        $prefix = $setting->prefix ?? null;
        $prefix = $setting->prefix ? $setting->prefix . ' - ' : $prefix;
        $format = "";

        if ($setting->format == 'number') {
            $format = $prefix . $inv;
        } else if ($setting->format == 'YYYY/00001') {
            $format = $prefix . date('Y') . '/' . $inv;
        } else if ($setting->format == '00001-YY') {
            $format = $prefix . $inv . '-' . date('y');
        } else if ($setting->format == '00001/MM/YY') {
            $format = $prefix . $inv . '/' . date('m') . '/' . date('y');
        }

        return $format;

    }

}


if (!function_exists('isActive')) {

    function isActive($routePattern = null, $class = 'active', $prfix = 'admin.')
    {
        // Convert to array
        $name = Route::currentRouteName();

        if (!is_array($routePattern) && $routePattern != null) {
            $routePattern = explode(' ', $routePattern);
        }

        foreach ((array)$routePattern as $i) {
            if (Str::is($prfix . $i, $name)) {
                return $class;
            }
        }

        foreach ((array)$routePattern as $i) {
            if (Str::is($i, $name)) {
                return $class;
            }
        }

    }

}

if (!function_exists('generateRandumCode')) {

    function generateRandumCode()
    {
        $rand = mt_rand(100000, 999999);
        return $rand;
    }
}

if (!function_exists('send_sms')) {

    function send_sms($message, $mobileno)
    {
        $name = "ADIARY";
        $mobileNumber = $mobileno;
        $email = "info@mnstechonogies.com";
        $senderId = "ADIARY";
        $routeId = "8";
        $authKey = "4afd691fc2a15e28b97e676f9876be3";
        $serverUrl = "msg.msgclub.net";
        sendsmsPOST($mobileNumber, $senderId, $routeId, $message, $serverUrl, $authKey);
    }
}

if (!function_exists('sendsmsPOST')) {
    function sendsmsPOST($mobileNumber, $senderId, $routeId, $message, $serverUrl, $authKey)
    {
        //Prepare you post parameters
        $postData = array(
            'mobileNumbers' => $mobileNumber,
            'smsContent' => $message,
            'senderId' => $senderId,
            'routeId' => $routeId,
            "smsContentType" => 'english'
        );

        $data_json = json_encode($postData);

        $url = "http://" . $serverUrl . "/rest/services/sendSMS/sendGroupSms?AUTH_KEY=" . $authKey;
        //$url="http://".$serverUrl."/rest/services/sendSMS/sendCustomGroupSms?AUTH_KEY=".$authKey;

        // init the resource
        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data_json,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0
        ));

        //get response
        $output = curl_exec($ch);


        //Print error if any
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
        return $output;
    }
}

if(!function_exists('date_difference')){
    function date_difference($date){

        $package_days = Package::first();
        
        $remaining_days = '';

        if($date != null){

            $today = Carbon::now();
            $date_difference = $today->diffInDays($date);

            if($date_difference < $package_days->validity){
                $remaining_days = $package_days->validity - $date_difference.' Days Remaining';
            }
        }

        return $remaining_days;
    }
}