<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use App\Model\JobPost;
use App\Model\UserJobApply;
use Illuminate\Http\Request;
use App\Traits\DatatablTrait;
use App\Http\Controllers\Controller;
use App\Model\JobType;
use Illuminate\Support\Facades\Storage;

class JobPostController extends Controller
{
    use DatatablTrait;

	public function index(){
		return view('admin.job_post.index');
	}

	public function show(Request $request,$id){
        $single_job_post = JobPost::findOrFail($id);
        
        if($request->ajax()){
            $html =  view('admin.job_post.model_view', compact('single_job_post'))->render();
            return response()->json(['html' => $html], 200);
        }else{
            return view('admin.job_post.view',compact('single_job_post'));
        }

	}

	public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'company_name',
            2 => 'job_title',
            3 => 'job_description',
            4 => 'category',
            5 => 'city',
            6 => 'experience',
            7 => 'qualification',
            8 => 'approve_status',
            9 => 'is_active',
            10 => 'action',
        );

        $totalData = JobPost::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $job_type = $request->job_type;
        $category = $request->category;
        $city = $request->city;
        $experience = $request->experience;
        $qualification = $request->qualification;
        $job_status_select2 = $request->job_status_select2;

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = JobPost::with(['qualification','experience','skill'])->when($search, function ($query, $search) {
            return $query->where('job_title', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%");
        })
        ->when($job_type,function($job_type_query)use($job_type){
            $job_type_query->whereHas('job_type',function($job_type_sub_query) use($job_type){
                $job_type_sub_query->where('job_type_id',$job_type);
            });
        })
        ->when($category,function($category_query)use($category){
            $category_query->whereHas('category',function($category_sub_query) use($category){
                $category_sub_query->where('category_id',$category);
            });
        })
        ->when($city,function($city_query) use ($city){
            $city_query->where('city_id',$city); 
        })  
        ->when($job_status_select2,function($job_status_select2_query) use ($job_status_select2){
            $job_status_select2_query->where('is_status',$job_status_select2);
        })
        ->when($experience,function($experience_query)use($experience){
            $experience_query->where('experience_id',$experience); 
        })
        ->when($qualification,function($qualification_query)use($qualification){
            $qualification_query->whereHas('qualification',function($qualification_sub_query) use($qualification){
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

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;
            
            $approve_status = '<span class="badge badge-warning">'.$item->is_status.'</span>';

            if($item->is_status == "Approved"){
                $approve_status = '<span class="badge badge-success">'.$item->is_status.'</span>';
            }elseif($item->is_status == "Expired"){
                $approve_status = '<span class="badge badge-danger">Job Closed</span>';
            }
            $row['company_name'] =  $item->user->name ?? 'N/A';
            $row['job_title'] =  '<a href="/admin/job-post/'.$item->id.'" style="white-space:normal;">'.str_limit($item->job_title,30).'</a>';
            
            $row['job_description'] =  str_limit($item->job_description, 40) ?? 'N/A';
            $row['category'] =  str_limit($item->category->pluck('name')->implode(','), 30) ?? 'N/A';
            $row['city'] =  $item->city->name ?? 'N/A';
            $row['experience'] =  str_limit($item->experience->name,20) ?? 'N/A';
            $row['qualification'] =  ($item->qualification->count() > 0) ? str_limit($item->qualification->pluck('name')->implode(','), 40) : 'N/A';
            
            
            $row['approve_status'] = $approve_status;

            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'job_post');

            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.view'),
                    'id' => $item->id,
                    'action' => route('admin.view_job_post', $item->id),
                    'icon' => 'fas fa-eye text-orange-red',
                ]),
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.job_post-edit', $item->id),
                    'icon' => 'fas fa-edit text-orange-red',
                ]),
                collect([
                    'text' => 'Change Status',
                    'id' => $item->id,
                    'action' => route('admin.change_job_status', $item->id),
                    'target' => '#changeStatus',
                    'icon' => 'fas fa-exchange-alt text-orange-red',
                ])
            ]);

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

    public function edit($id){
        $this->data['job_post'] = JobPost::findOrFail($id);
        $this->data['job_type'] = JobType::where('is_active','Yes')->get();
        
        return view('admin.job_post.edit',$this->data);
    }

    public function update(Request $request){

        $gender = implode(',',$request->gender);

        $age_limit = null;

        if($request->is_age_limit != null){
            $age_limit = $request->age_limit;
        }


        $job_post = JobPost::findOrFail($request->id);
        $job_post->job_title = $request->job_title;
        $job_post->job_description = $request->job_description;
        $job_post->location = $request->job_location;
        $job_post->vacancy = $request->no_position;
        $job_post->gender = $gender;
        $job_post->experience_id = $request->experience;
        $job_post->state_id = $request->state;
        $job_post->city_id = $request->city;
        $job_post->minimum_salary = $request->minimum_salary;
        $job_post->maximum_salary = $request->maximum_salary;
        $job_post->is_age_limit = $request->is_age_limit;
        $job_post->age_limit = $age_limit;
        $job_post->save(); 

        if ($request->qualification != "") {
            $job_post->qualification()->sync($request->qualification);
        }
        if ($request->skill != "") {
            $job_post->skill()->sync($request->skill);
        }
        if ($request->known_languages != "") {
            $job_post->known_languages()->sync($request->known_languages);
        }
        if ($request->marital_status != "") {
            $job_post->marital_status()->sync($request->marital_status);
        }
        if ($request->shift != "") {
            $job_post->shift()->sync($request->shift);
        }

        if ($request->job_type != "") {
            $job_post->job_type()->sync($request->job_type);
        }
        if ($request->job_category != "") {
            $job_post->category()->sync($request->job_category);
        }

        return redirect()->route('admin.job_post')->with('success', 'Job Post Successfully Updated');
    }

    public function changeStatus($id){

        $this->data['job'] = JobPost::findorfail($id);

        $html =  view('admin.job_post.change_status',$this->data)->render();
        return response()->json(['html' => $html], 200);
    }

    public function updateStatus(Request $request){

        $update = JobPost::findOrFail($request->job_id);
        $update->is_status = $request->is_status;
        $update->save();

        return redirect()->route('admin.job_post')->with('success', 'Status Successfully Updated');

    }

    public function jobPostUser(Request $request)
    {
        $job_post = $request->id;

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'mobile',
            4 => 'action',
        );

        $totalData = User::whereHas('user_job_apply',function($query) use ($job_post){
                                $query->where('job_id',$job_post);
                            })->count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = User::whereHas('user_job_apply',function($query) use ($job_post){
                                    $query->where('job_id',$job_post);
                                })->when($search, function ($query, $search) {
                                    return $query->where('name', 'LIKE', "%{$search}%")
                                                ->orWhere('id', 'LIKE', "%{$search}%");
                                });
        
        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['name'] =  '<a href="/admin/job-seeker/'.$item->id.'" style="color:#000; cursor:pointer;">'.$item->name.'</a>';
            $row['email'] =  $item->email;
            $row['mobile'] = $item->mobile;

            //dd($row['is_active']);
            $row['action'] = $this->action([
                 collect([
                    'text' => __('common.view'),
                    'id' => $item->id,
                    'action' => route('admin.job_seeker-view', $item->id),
                    'icon' => 'fas fa-eye text-orange-red',
                ])
            ]);

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
}
