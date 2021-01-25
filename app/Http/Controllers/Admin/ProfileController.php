<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Storage;
use Validator;
use Session;
use Hash;
use File;
use Image;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $adminuser = Auth::user()->id ?? null;
        

        $user = request()->user(); //getting the current logged in user
        
        $data['admin'] = User::findorfail($adminuser);
        
        return view('admin.profile.profile', $data);
    }
    
    public function overviewIndex()
    {
        $adminuser = Auth::user()->id ?? null;


        $user = request()->user(); //getting the current logged in user

        $data['admin'] = User::findorfail($adminuser);

        return view('admin.profile.overview', $data);
    }

    public function changepasswordIndex()
    {
        $adminuser = Auth::user()->id ?? null;


        $user = request()->user(); //getting the current logged in user

        $data['admin'] = User::findorfail($adminuser);
        //dd($data);
        return view('admin.profile.change-password', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function profileChange(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'name' => 'required|max:255',
//            'email' => 'required|email|max:255|unique:admins,email,' . $request->admin_id
        ]);

        if ($validator->passes()) {
            $admin = User::findorfail($request->admin_id);
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->save();

            Session::flash('success', "Profile has been updated successfully.");
            return redirect('admin/profile');
        }

        return back()->with('errors', $validator->errors());
    }

    public function passwordChange(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validator->passes()) {
            $admin = User::findorfail($request->admin_id);
            if (Hash::check($request->old_password, $admin->password)) {

                $admin->password = Hash::make($request->password);
                try {
                    $admin->save();
                    $flag = TRUE;
                } catch (Exception $e) {
                    $flag = FALSE;
                }
                if ($flag) {
                    Session::flash('success', 'Password has been changed successfully.');
                    return redirect('admin/profile-change-password');
                } else {
                    Session::flash('error', 'Unable to process request this time. Try again later.');
                    return redirect('admin/profile-change-password');
                }
            }
            Session::flash('error', "Your current password do not match in our record. Try to enter valid password");
            return redirect('admin/profile-change-password');
        }
        return back()->with('errors', $validator->errors());
    }

    public function changeProfilImage(Request $request, $id)
    {

        $status = 400;

        $admin = User::findorfail($id);

        $oldImage = $admin->profile_image;
      
        $var = preg_split("#/#",  $oldImage); 
       // dd($var[5]);
        //$aa = explode("",$oldImage);
        //dd($aa[0]);
        $oldImageThum = $admin->thum_path;

        $file_data = $request->input('image');
       
       // dd($oldImageThum);

        $file_name = 'image_' . time() . '.png'; //generating unique file name;


        $url = 'profile_image/' . $file_name; //generating unique file name;
        // $thumPath = 'profile/'.$admin->id.'/thum/'. $file_name;
        
    
        


        @list($type, $file_data) = explode(';', $file_data);

        @list(, $file_data) = explode(',', $file_data);

        if ($file_data != "") { // storing image in storage/app/public Folder
            $isUploda = Storage::disk('public')->put($url, base64_decode($file_data));
            
            // Storage::disk('public')->put($thumPath, base64_decode($file_data));

            if ($isUploda) {
                Storage::delete($oldImage);
                Storage::disk('public')->delete($oldImageThum);
            }

            $admin->profile_image = $url;
            // $admin->thum_path =  $thumPath;

            // Image::make($file_data)->resize(null, 200, function ($constraint) {
            //     $constraint->aspectRatio();
            //     $constraint->upsize();
            // })->save('storage/' . $thumPath);
            
            $admin->save();

            $status = 200;
        }

        return response()->json([
            'success' => true,
            'message' => 'Profile Upload successfully',
            'image_url' => asset('storage/'.$admin->profile_image),
        ], $status);


    }
}
