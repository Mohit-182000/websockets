<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Package;
use App\Model\Payment;
use Carbon\Carbon;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.payment.index');
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

    public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'job',
            3 => 'package',
            4 => 'subscription_date',
            5 => 'expiry_date',
            6 => 'status',
            7 => 'action',
        );

        $totalData = Payment::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $user_type = $request->user_type;
        
        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Payment::when($search, function ($query, $search) {
            return $query->where('id', 'LIKE', "%{$search}%")
            ->orWhere('id', 'LIKE', "%{$search}%");
        })
        ->when($user_type,function($user_type_query) use ($user_type){
            return $user_type_query->where('user_type',$user_type);
        });

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];
        
        $today = Carbon::now();
        $jobseeker_package_days = Package::where('package_user_type','JOBSEEKER')->first();
        $employer_package_days = Package::where('package_user_type','EMPLOYER')->first();


        foreach ($customcollections as $key => $item) {

            $date_difference = $today->diffInDays($item->created_at);

            $expiry_date = 'N/A';
            $status = '<span class="badge badge-success">Active</span>';

            if($item->user->user_type == 'EMPLOYER'){
                $days = $employer_package_days->validity - $date_difference;
                $expiry_date = date('d-M-Y',strtotime($item->created_at->addDays($days)));
                
                if($date_difference > $employer_package_days->validity){
                    $status = '<span class="badge badge-danger">Expired</span>';
                }

            }else{
                $days = $jobseeker_package_days->validity - $date_difference;
                $expiry_date = date('d-M-Y',strtotime($item->created_at->addDays($days)));

                if($days > $jobseeker_package_days->validity){
                    $status = '<span class="badge badge-danger">Expired</span>';
                }
            }

            $row['id'] = $item->id;

            $row['name'] =  str_limit($item->user->name.' ( '.$item->user_type.' )',30);
            $row['job'] =  str_limit($item->job->job_title ?? 'N/A',30);
            $row['package'] =  $item->package->name;
            $row['subscription_date'] =  date('d-M-Y',strtotime($item->created_at));
            $row['expiry_date'] =  $expiry_date;
            // $row['expiry_date'] =  $days;
            $row['status'] = $status;

            $row['action'] = $this->action([
                collect([
                    'text' => __('common.view'),
                    'id' => $item->id,
                    'action' => route('admin.payment.show', $item->id),
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['payment'] = Payment::findOrFail($id);
        return view('admin.payment.view',$this->data);
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
