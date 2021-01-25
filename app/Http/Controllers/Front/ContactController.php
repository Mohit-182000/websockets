<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ContactUs;
use Session;
use App\Http\Requests\ContactUsFormRequest;

class ContactController extends Controller
{
    

    public function index()
    {
        $this->data['title'] = "Contact";
        //dd(1);
        return $this->view('website.contact.contact');
    }

    public function store(Request $request)
    {

        //dd($request->all());
        $contactUs = new  ContactUs();
        $contactUs->name = $request->name;
        $contactUs->email = $request->email;
        $contactUs->phone = $request->mobile;
        $contactUs->subject = $request->subject;
        $contactUs->message = $request->message;
        $contactUs->save();

        Session::flash('success', 'Contact submited successfully');
        //session()->set('success','Item created successfully.');
        return back();

    }
}
