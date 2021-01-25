<?php

namespace App\Http\Controllers\Admin;

use App\Model\Mailsetup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MailValidation;
use Auth;

class MailsetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $mailsetup  = Mailsetup::findOrfail(1); 
        // $this->data['title'] = 'Mailsetup' ;
        // $this->data['mailsetup'] = $mailsetup;        
        // return view('admin.mailsetup.edit', $this->data);

        $this->data['mailsetup']  = Mailsetup::find(1); 
        
        if($this->data['mailsetup']){
            return view('admin.mailsetup.edit', $this->data);
        }else{
            return view('admin.mailsetup.edit');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MailValidation $request, $id)
    {
       // dd($request->all());

    //    $mailsetup  = Mailsetup::findOrfail($id);
       $mailsetup  = Mailsetup::firstOrNew(['id' => $id]);;

        
        $mailsetup->mail_driver  = $request->mail_driver;

        $mailsetup->mail_host      = $request->mail_host;
        $mailsetup->mail_port      = $request->smtp_port;

        $mailsetup->mail_encryption= $request->mail_encryption;


        $mailsetup->mail_username  = $request->smtp_username;

        $mailsetup->mail_password  = $request->smtp_password;


        $mailsetup->save();

        return back()->with('success', __('mailsetup.update.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
