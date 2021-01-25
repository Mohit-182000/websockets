<?php

namespace App\Http\Controllers\Admin;

use App\Model\Setting;
use App\Model\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $this->data['title'] = 'Settings';
        $this->data['site_date_format'] = date_format_list();
        $this->data['currency_list']  = Currency::all();
        $this->data['setting'] = Setting::with('country' ,'state' ,'city')->find(1);
        return $this->view('admin.setting.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function termIndex(){
        $this->data['title'] = 'Term Condition';
        return $this->view('admin.setting.term',$this->data);
    }
    public function termStore(Request $request){
        $setting = Setting::find(1);
        $setting->term_condition      = $request->term_condition;
        $setting->save();
        return redirect()->route('admin.term.index')->with('success',' Terms & Conditions updated Successfully.');
    }

    public function store(Request $request)
    {
        $textFirst = str_replace("<p>", '<p><span style="font-size:20px">',$request->address_name);
        $text = str_replace("</p>", '</span></p>',$textFirst);
        // dd($text);
        // $request->validate([
        //     'favicon' => 'dimensions:width=33,height=35',
        //     'logo' => 'dimensions:width=133,height=35'
        // ],[
        //     'favicon.dimensions' => 'Favicon size must be 33 x 35',
        //     'logo.dimensions' => 'Logo size must be 133 x 35',
        // ]);

        $setting = Setting::find(1);
        $setting->store_name      = $request->store_name;
        $setting->store_email     = $request->email;
        $setting->store_contact   = $request->contact_us;
        $setting->address_name    = $request->address_name;
        $setting->address_email   = $request->address_email;
        $setting->address_contact = $request->address_contact_us;
        $setting->country_id      = $request->country;
        $setting->state_id        = $request->state;
        $setting->city_id         = $request->city_id;
        $setting->pincode         = $request->postal_code;
        $setting->site_date_format = $request->site_date_format;
        $setting->time_zone        = $request->timezone;
        $setting->currency_name    = $request->currency_name;
        $setting->currency_symbol  = $request->currency_symbol;
        $setting->currency_format  = $request->currency_format;
        $setting->thousan_separator  = $request->thousan_separator;
        $setting->decimal_separator  = $request->decimal_separator;
        $setting->no_of_decimal      = $request->no_of_decimal;
        $setting->offers_slider      = $request->offers_slider;
        $setting->minimum_salary      = $request->minimum_salary;
        $setting->maximum_salary      = $request->maximum_salary;
        $setting->offers      = $request->offers;
        $setting->terms_and_condition      = $request->terms_and_condition;
        $setting->privacy_policy      = $request->privacy_policy;

        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $file->storeAs('generalsetting/' , $fileName, ['disk' => 'public']);
            Storage::delete('public/generalsetting/' . $setting->favicon);
            $setting->favicon = $fileName??NULL;
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
            $fileName = str_replace(' ', '_', $fileName);
            $file->storeAs('generalsetting/' , $fileName, ['disk' => 'public']);
            Storage::delete('public/generalsetting/' . $setting->logo);
            $setting->logo = $fileName??NULL;
        }

        $setting->prefix = $request->prefix ;
        $setting->invoice_formet = $request->invoice_formet;

        $setting->social = json_encode([
            'facebook'  => $request->facebook,
            'twitter'   => $request->twitter,
            'youtube'   => $request->youtube,
            'instagram' => $request->instagram,
            'linkedin'  => $request->linkin,
        ]);
        $setting->save();

        Cache::forget('default_setting');

        return redirect()->route('admin.settings.index')->with('success','Settings updated Successfully.');

    }



    public function edit(Setting $setting)
    {
        $this->data['title'] = 'Settings' ;
        return view('admin.settings.edit', $this->data);
    }


}
