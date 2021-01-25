<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use App\Model\JobPost;
use Illuminate\Http\Request;
use App\Traits\DatatablTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserJobApplyController extends Controller
{
	use DatatablTrait;

	public function index(){
		return view('admin.user_job_apply.index');
	}

	public function show($id){
		$single_job_view = User::findOrFail($id);
		return view('admin.user_job_apply.view',compact('single_job_view'));
	}

	public function dataList(Request $request)
    {


        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'title',
            2 => 'no_of_post',
            3 => 'last_date_of_exam',
            4 => 'is_active',
            5 => 'action',
        );

        $totalData = User::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = User::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%");
        });
        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];

        foreach ($customcollections as $key => $item) {
            // dd(route('admin.brand.edit', $item->id));
            $row['id'] = $item->id;

            $row['name'] =  $item->name;
            $row['email'] =  $item->email;


            //dd($row['is_active']);
            $row['action'] = $this->action([
                 collect([
                    'text' => __('common.view'),
                    'id' => $item->id,
                    'action' => route('admin.view_user_job_apply', $item->id),
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
