<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Model\UserJobApply;
use App\Model\JobPost;
use Illuminate\Http\Request;
use App\Traits\DatatablTrait;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Storage;
use PDF;

class JobSeekerController extends Controller
{
	use DatatablTrait;

	public function index(){
		return view('admin.job_seeker.index');
	}

	public function show($id){
        $single_user = User::findOrFail($id);
		return view('admin.job_seeker.view',compact('single_user'));
	}

	public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'mobile',
            3 => 'category',
            4 => 'city',
            5 => 'qualification',
            6 => 'experience',
            7 => 'applied_count',
            8 => 'is_active',
            9 => 'action',
            10 => 'chat',
        );

        $totalData = User::where('user_type','jobseeker')->count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $category = $request->category;
        $city = $request->city;
        $qualification = $request->qualification;

        $customcollections = User::where('user_type','jobseeker')->when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%");
        })
        ->when($category,function($category_query) use ($category){
            return $category_query->whereHas('category',function($category_sub_query) use ($category){
                $category_sub_query->where('category_id',$category);
            });
        })
        ->when($city,function($city_query) use ($city){
            return $city_query->where('city_id',$city);
        })
        ->when($qualification,function($qualification_query) use ($qualification){
            return $qualification_query->whereHas('qualification',function($qualification_sub_query) use ($qualification){
                $qualification_sub_query->where('qualification_id',$qualification);
            });
        });

        $totalFiltered = $customcollections->count();

        if($request->input('length') == -1){
            $customcollections = $customcollections->limit($limit)->orderBy($order, $dir)->get();
        }else{
            $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();
        }

        $data = [];
        $applied_count = '';
        foreach ($customcollections as $key => $item) {

            $date = 'N/A';

            if($item->work_experience->count() != 0){
                
                $date = humanTiming($item->work_experience->first()->start_date,$item->work_experience->first()->end_date);
            }


            $row['id'] = $item->id;

            $row['name'] =  '<a href="/admin/job-seeker/'.$item->id.'">'.$item->name.'</a>';
            $row['mobile'] =  $item->mobile ?? 'N/A';
            $row['category'] = str_limit($item->category->pluck('name')->implode(',') ?? '' , 20);
            $row['city'] = $item->city->name ?? 'N/A';
            $row['qualification'] = $item->qualification->first()->qualificationDetail->name ?? 'N/A';
            // $row['experience'] = humanTiming($item->work_experience->first()->start_date,$item->work_experience->first()->end_date);
            $row['experience'] = $date;
            $row['applied_count'] = $item->user_job_apply->count() ?? 0;
            
            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'users');

            //dd($row['is_active']);
            $row['action'] = $this->action([
                 collect([
                    'text' => __('common.view'),
                    'id' => $item->id,
                    'action' => route('admin.job_seeker-view', $item->id),
                    'icon' => 'fas fa-eye text-orange-red',
                ])
            ]);
            
            $row['chat'] = '<a href="/admin/chat?user='.encrypt($item->id).'"><i style="font-size:25px;" class="fas fa-comment-dots"></i></a>';

            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );

        return response()->json($json_data);
    }

    public function userJobApplyList(Request $request)
    {

        $user_id = $request->id;

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'job_title',
            2 => 'company_name',
            3 => 'location',
            4 => 'applied_on',
            // 5 => 'action',
        );

        $totalData = JobPost::WhereHas('user_job_apply', function($q) use ($user_id){
                                        $q->where(['user_id' => $user_id,'is_shortlisted' => 0]);
                            })->count(); 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query

        $customcollections = JobPost::WhereHas('user_job_apply', function($q) use ($user_id){
                                        $q->where(['user_id' => $user_id,'is_shortlisted' => 0]);
                                    })
                                    ->with(['experience','qualification:id,name'])
                                    ->when($search, function ($query, $search) {
                                        return $query->where('job_title', 'LIKE', "%{$search}%")
                                        ->orWhere('id', 'LIKE', "%{$search}%");
                                    });


        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];
        //dd($customcollections); 

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            
            $row['id'] = $item->id;

            $row['job_title'] =  '<a href="/admin/job-post/'.$item->id.'" >'.str_limit($item->job_title,20).'</a>';

            $row['company_name'] =  $item->user->name;
            $row['location'] =  $item->location;
            $row['applied_on'] =  ($item->user_job_apply[0]['applied_date'] != null) ? date('d-m-Y',strtotime($item->user_job_apply[0]['applied_date'])) : 'N/A';

            //dd($row['is_active']);
            // $row['action'] = $this->action([
            //      collect([
            //         'text' => __('common.view'),
            //         'id' => $item->id,
            //         'action' => route('admin.view_job_post', $item->id),
            //         'icon' => 'fas fa-eye text-orange-red',
            //     ])
            // ]);

            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        
        return response()->json($json_data);
    }

    public function generateResume(){
        
        $this->data['basic_details'] = User::first();
        // $this->data['image'] = '<img src="'.asset('storage/profile_image/'.$this->data['basic_details']->profile_image).'"/>';
        
        $this->data['image'] = public_path("storage/profile_image/").$this->data['basic_details']->profile_image;
        $this->data['email'] = public_path("storage/default/email.png");
        $this->data['mobile'] = public_path("storage/default/mobile.png");
        $this->data['location'] = public_path("storage/default/location.png");
        $this->data['dob'] = public_path("storage/default/dob.png");
        
        $pdf = PDF::loadView('admin.job_seeker.resume', $this->data);
        // return view ('admin.job_seeker.resume', $this->data);
        
        return $pdf->stream();
    }
		
}
