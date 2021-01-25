<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\User;
use App\Model\JobPost;
use App\Http\Controllers\Controller;
use App\Model\UserJobApply;
//use App\Model\News;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $dataset = [];

            if($request->chart_value){
                for($i = 0; $i < $request->chart_value; $i++){
                    $dataset[] = [
                        'dates' => Carbon::today()->subDays($i)->format('d-M'),
                        'data' => JobPost::whereDate('created_at',Carbon::today()->subDays($i))->count(),
                    ];
                }
            }
            $dates = array_column($dataset,'dates');
            $data = array_column($dataset,'data');
            // dd($data);
            return response()->json(['dates' => $dates,'data' => $data]);
        }

        $date = Carbon::today();
        
        $this->data['title'] ="Dashboard";
        $this->data['job_seeker'] = User::where('user_type','JOBSEEKER')->count();
        $this->data['employer'] = User::where('user_type','EMPLOYER')->count();
        $this->data['job_post'] = JobPost::count();

        $this->data['latest_employer'] = User::where('user_type','EMPLOYER')->latest()->take(3)->get();
        $this->data['latest_job_seeker'] = User::where('user_type','JOBSEEKER')->latest()->take(4)->get();
        
        $this->data['latest_job_post'] = JobPost::latest()->take(5)->get();        
        
        $this->data['total_job_post'] = JobPost::count();        
        $this->data['today_job_post'] = JobPost::whereDate('created_at',$date)->count();
        
        $this->data['total_user_apply'] = UserJobApply::count();        
        $this->data['today_user_apply'] = UserJobApply::whereDate('created_at',$date)->count();
        
        $this->data['total_profile_creation'] = User::count();        
        $this->data['today_profile_creation'] = User::whereDate('created_at',$date)->count();

        $this->data['total_shortlist'] = UserJobApply::where('is_shortlisted',1)->count();        
        $this->data['today_shortlist'] = UserJobApply::whereDate('created_at',$date)->where('is_shortlisted',1)->count();

        return view('admin.index', $this->data);
    }

    public function jobAppliedChart(Request $request){
        $dataset = [];

        if($request->job_applied_chart_value){
            for($i = 0; $i < $request->job_applied_chart_value; $i++){
                $dataset[] = [
                    'dates' => Carbon::today()->subDays($i)->format('d-M'),
                    'data' => UserJobApply::whereDate('created_at',Carbon::today()->subDays($i))->count(),
                ];
            }
        }
        $dates = array_column($dataset,'dates');
        $data = array_column($dataset,'data');
        
        return response()->json(['dates' => $dates,'data' => $data]);
    }

    public function profileCreationChart(Request $request){
        $dataset = [];

        if($request->profile_creation_chart_value){
            for($i = 0; $i < $request->profile_creation_chart_value; $i++){
                $dataset[] = [
                    'dates' => Carbon::today()->subDays($i)->format('d-M'),
                    'data' => User::whereDate('created_at',Carbon::today()->subDays($i))->count(),
                ];
            }
        }
        $dates = array_column($dataset,'dates');
        $data = array_column($dataset,'data');
        
        return response()->json(['dates' => $dates,'data' => $data]);
    }

    public function shortlisted(Request $request){
        $dataset = [];

        if($request->shortlist_chart_value){
            for($i = 0; $i < $request->shortlist_chart_value; $i++){
                $dataset[] = [
                    'dates' => Carbon::today()->subDays($i)->format('d-M'),
                    'data' => UserJobApply::whereDate('created_at',Carbon::today()->subDays($i))->where('is_shortlisted',1)->count(),
                ];
            }
        }
        $dates = array_column($dataset,'dates');
        $data = array_column($dataset,'data');
        
        return response()->json(['dates' => $dates,'data' => $data]);
    }

    public function create()
    {
        //
        return view('admin.create');
    }

    public function swapBranch(Request $request, $id)
    {

        Session::put('main_branch', true);

        $user = Admin::where('branch_user', 'Yes')->where('branch_id', $id)->first();

        // for main branch
        if ($id == 0) {
            $user = Admin::findOrfail(1);
            Auth::guard('admin')->loginUsingId($user->id);
            return redirect()->route('admin.dashboard');
        }

        if ($user && $user->branch_user == 'Yes') {
            Auth::guard('admin')->loginUsingId($user->id);
            return redirect()->route('admin.dashboard');
        }


        return redirect()->back();

    }


}
