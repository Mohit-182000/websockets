<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Inquiry;
use App\Traits\DatatablTrait;

class InquiryController extends Controller
{
    use DatatablTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->data['title'] ="Inquiry";
        return $this->view('admin.inquiry.index');
    }


    public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
               
            0 => 'child_name',           
            1 => 'email',           
            2 => 'phone',           
            3 => 'created_at',           
           
        );


        $totalData = Inquiry::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Inquiry::when($search, function ($query, $search) {
            return $query->where('child_name', 'LIKE', "%{$search}%")
            ->orwhere('email', 'LIKE', "%{$search}%")
            ->orwhere('phone', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];
        // dd($customcollections);
        foreach ($customcollections as $key => $item) {
            
         
            $row['id'] = $item->id;
            //$row['subject'] = '<p>'.$item->subject.'</p>';
            $row['child_name'] = '<p>'.$item->child_name.'</p>';
            $row['email'] = '<p>'.$item->email.'</p>';
            $row['phone'] = '<p>'.$item->phone.'</p>';
            $row['created_at'] = '<p>'.date('d-m-Y',strtotime($item->created_at)).'</p>';

             // $row['action'] = "<button tabindex='0' type='button' class='btn btn-secondary fa fa-eye' data-container='body' data-toggle='popover' data-placement='left' data-content='{$item->message}' data-trigger='focus'></button>";
            $row['action'] = $this->action([
                collect([
                    'text'=>'View',
                    'id' => $item->id,
                    'action' => route('admin.inquiry.show', $item->id),
                    'target' => '#showcontact',
                    'icon' => 'fa fa-eye',
                    'permission' =>  true
                ]),
                collect([
                    'text'=> __('common.action.delete'),
                    'id' => $item->id,
                    'action' => route('admin.inquiry.destroy', $item->id),
                    'icon' => 'fa fa-trash',
                    'class' => 'delete-confrim',
                    'permission' =>  true
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
        $inquiry = Inquiry::findOrFail($id);
                //dd($inquiry);
                //dd($contact);
                $html = view('admin.inquiry.show',[ 'inquiry' => $inquiry])->render() ;
                return response()->json([ 'html' => $html ], 200);  
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
         $inquiry = Inquiry::findOrFail($id);
                       if($inquiry->delete()) {
                         $statuscode = 200;
                        }
                        
                        return response()->json([
                        'success' => true ,
                        'message' => 'Inquiry deleted successfully.'
                        ],200);
    }
}
