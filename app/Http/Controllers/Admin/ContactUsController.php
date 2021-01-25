<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ContactUs;
use App\Traits\DatatablTrait;

class ContactUsController extends Controller
{
    use DatatablTrait;

	  public function index()
    {
        $this->data['title'] = __('contactus.index_title');
        return $this->view('admin.contact.index');
    }

      public function dataList(Request $request)
    {
        // Listing colomns to show
        $columns = array(
            0 => 'subject',           
            1 => 'name',           
            2 => 'email',           
            3 => 'phone',           
            4 => 'created_at',           
           
        );


        $totalData = ContactUs::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = ContactUs::when($search, function ($query, $search) {
            return $query->where('subject', 'LIKE', "%{$search}%")
            ->orwhere('name', 'LIKE', "%{$search}%")
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
            $row['subject'] = '<p>'.$item->subject.'</p>';
            $row['name'] = '<p>'.$item->name.'</p>';
            $row['email'] = '<p>'.$item->email.'</p>';
            $row['phone'] = '<p>'.$item->phone.'</p>';
            $row['created_at'] = '<p>'.date('d-m-Y',strtotime($item->created_at)).'</p>';

             // $row['action'] = "<button tabindex='0' type='button' class='btn btn-secondary fa fa-eye' data-container='body' data-toggle='popover' data-placement='left' data-content='{$item->message}' data-trigger='focus'></button>";
            $row['action'] = $this->action([
                collect([
                    'text'=>'View',
                    'id' => $item->id,
                    'action' => route('admin.contactus.show', $item->id),
                    'target' => '#showcontact',
                    'icon' => 'fa fa-eye',
                    'permission' =>  true
                ]),
                collect([
                    'text'=> __('common.action.delete'),
                    'id' => $item->id,
                    'action' => route('admin.contactus.destroy', $item->id),
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

    public function show($id){
                $contact = ContactUs::findOrFail($id);
                //dd($contact);
                $html = view('admin.contact.show',[ 'contact' => $contact])->render() ;
                return response()->json([ 'html' => $html ], 200);  
      
    }

    public function destroy($id)
    {
        //dd($id);

                       $contact = ContactUs::findOrFail($id);
                       if($contact->delete()) {
                         $statuscode = 200;
                        }
                        
                        return response()->json([
                        'success' => true ,
                        'message' => 'Contact Us deleted successfully.'
                        ],200);
                  
    }
  
}
