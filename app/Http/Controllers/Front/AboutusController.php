<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\About;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //- - - - - - - - - - - - - About School- - - - - - - - - - - -//
    public function index()
    {
        
    
        // $this->data['about']          = About::findOrCreate(1);
         return view('website.about.about_school');
         
    }

    //- - - - - - - - - - - - - Mission & Vision - - - - - - - - - - - -//
    public function missionVision()
    {
        
    
        // $this->data['about']          = About::findOrCreate(1);
         return view('website.about.mission_vision');
        
    }

    //- - - - - - - - - - - - - About Lokpriya Foundataion - - - - - - - - - - - -//
    public function aboutLokpriyaFoundataion()
    {
        
    
        // $this->data['about']          = About::findOrCreate(1);
         return view('website.about.about_lokpriya_foundation');
        
    }

    //- - - - - - - - - - - - - Chairperson Message - - - - - - - - - - - -//
    public function chairpersonMessage()
    {
        
    
        // $this->data['about']          = About::findOrCreate(1);
         return view('website.about.chairperson_message');
        
    }

    //- - - - - - - - - - - - - Principal Message - - - - - - - - - - - -//
    public function principalMessage()
    {
        
    
        // $this->data['about']          = About::findOrCreate(1);
         return view('website.about.principal_message');
        
    }

    //- - - - - - - - - - - - - Beyond Academics - - - - - - - - - - - -//
    public function beyondAcademics()
    {
        
    
        // $this->data['about']          = About::findOrCreate(1);
         return view('website.about.beyond_academics');
        
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
