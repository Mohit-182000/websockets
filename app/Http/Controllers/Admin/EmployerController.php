<?php

namespace App\Http\Controllers\admin;

use App\User;
use App\Model\JobPost;
use App\Model\UserJobApply;
use Illuminate\Http\Request;
use App\Traits\DatatablTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployerFormRequest;
use App\Model\UserWorksapcePhoto;
use Illuminate\Support\Facades\Storage;

class EmployerController extends Controller
{
    use DatatablTrait;

    public function index()
    {
        return view('admin.employer.index');
    }

    public function show($id)
    {
        $single_employer = User::findOrFail($id);
        return view('admin.employer.view', compact('single_employer'));
    }

    public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'mobile',
            4 => 'no_of_job_post',
            5 => 'applied_no_of_job_post',
            6 => 'is_active',
            7 => 'action',
            8 => 'chat',
        );

        $totalData = User::where('user_type', 'employer')->count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $company_type = $request->company_type;
        $industries = $request->industries;
        $category = $request->category;
        $city = $request->city;

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = User::where('user_type', 'employer')->when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('id', 'LIKE', "%{$search}%");
        })
        ->when($company_type,function($company_type_query) use($company_type){
            $company_type_query->where('company_type_id',$company_type);
        })
        ->when($city,function($city_query) use($city){
            $city_query->where('city_id',$city);
        })
        ->when($category,function($category_query) use($category){
            $category_query->whereHas('category',function($category_sub_query) use($category){
                $category_sub_query->where('category_id',$category);
            });
        })
        ->when($industries,function($industries_query) use($industries){
            $industries_query->whereHas('interests',function($industries_sub_query) use($industries){
                $industries_sub_query->where('interests_id',$industries);
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

            $count = UserJobApply::whereIn('job_id',[$item->user_job_post->pluck('id')->implode(',')])->count();
            
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['name'] =  '<a href="/admin/employer/' . $item->id . '">' . $item->name . '</a>';
            $row['email'] =  $item->email ?? 'N/A';
            $row['mobile'] = $item->mobile ?? 'N/A';
            $row['no_of_job_post'] = $item->user_job_post->count() ?? 0;
            $row['applied_no_of_job_post'] = $count ?? 0;

            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'users');

            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.view'),
                    'id' => $item->id,
                    'action' => route('admin.employer-view', $item->id),
                    'icon' => 'fas fa-eye text-orange-red',
                ]),
                collect([
                    'text' => __('common.edit'),
                    'id' => $item->id,
                    'action' => route('admin.employer-edit', $item->id),
                    'icon' => 'fas fa-edit text-orange-red',
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

    public function employerJobPost(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'job_title',
            2 => 'vacancy',
            3 => 'salary',
            4 => 'action',
        );

        $totalData = JobPost::where('user_id', $request->id)->count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = JobPost::where('user_id', $request->id)->when($search, function ($query, $search) {
            return $query->where('job_title', 'LIKE', "%{$search}%")
                ->orWhere('id', 'LIKE', "%{$search}%");
        });
        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();
        $data = [];

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['job_title'] =  str_limit($item->job_title,30);
            $row['vacancy'] =  $item->vacancy;
            $row['salary'] = $item->minimum_salary . ' - ' . $item->maximum_salary;

            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => 'View',
                    'id' => $item->id,
                    'action' => route('admin.view_job_post', $item->id),
                    'target' => '#viewJob',
                    'icon' => 'fas fa-eye text-dark-pastel-green',
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

    public function employerJobUserApply(Request $request)
    {
        $job_id = JobPost::where('user_id',$request->id)->pluck('id')->implode(',');

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'qualification',
            3 => 'excepted_salary',
            4 => 'action',
        );

        $totalData = UserJobApply::whereIn('job_id',[$job_id])->count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = UserJobApply::whereIn('job_id',[$job_id])->with(['user'])->when($search, function ($query, $search) {
            return $query->where('job_title', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%");
        })->with(['user.qualification']);
        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {

            $row['id'] = $item->user->id;

            $row['name'] =  '<a href="'.route('admin.job_seeker-view', $item->user->id).'">'.$item->user->name.'</a>';
            
            $row['qualification'] =  ($item->user->qualification->count() != 0) ? $item->user->qualification->first()->field_of_study : 'N/A';

            $row['excepted_salary'] =  $item->user->expected_salary ?? 'N/A';
            
            //dd($row['is_active']);
            $row['action'] = $this->action([
                collect([
                    'text' => __('common.view'),
                    'id' => $item->id,
                    'action' => route('admin.job_seeker-view', $item->user->id),
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

    public function edit($id){
        $employer_profile = User::findOrFail($id);

        return view('admin.employer.edit',compact('employer_profile'));
    }

    public function update(EmployerFormRequest $request){
        // dd($request->all());
        
        $user = User::findOrFail($request->id);
        $user->name = $request->company_name;
        $user->profile_image = employerUploadImage('company_logo','profile_image',$user->profile_image);
        $user->company_type_id = $request->company_type;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->about_company = $request->about_company;
        $user->address = $request->company_address;
        $user->state_id = $request->state;
        $user->city_id = $request->city;
        $user->locality_id = $request->locality;
        $user->save();

        $user_id = $user->id;

        if ($request->hasFile('workspace_photo')) {

            foreach ($request->workspace_photo as $workspace_file) {

                $workspace_photo_name = time() . '_' . rand(0, 500) . '_' . $workspace_file->getClientOriginalName();

                $workspace_photo_name = str_replace(' ', '_', $workspace_photo_name);

                $workspace_file->storeAs('workspace_photo/', $workspace_photo_name);

                $add = new UserWorksapcePhoto;
                $add->user_id = $user_id;
                $add->workspace_photo = $workspace_photo_name;
                $add->save();
            }
        }

        return redirect()->route('admin.employer-index')->with('success', 'Employer Successfully Updated');

    }

    public function workSpaceImage(Request $request){       
        $id = $request->image_id;
        
        $delete = UserWorksapcePhoto::findOrFail($id);
        $delete->delete();

        Storage::delete('workspace_photo/' . $delete->images);

        return response()->json([
            'success' => true,
            'message' => 'Deleted',
        ], 200);
    }
}
