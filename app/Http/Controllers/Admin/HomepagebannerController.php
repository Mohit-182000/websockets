<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannerValidation;
use App\Model\Homepagebanner;
use App\Traits\DatatablTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use Image;
use Auth;

class HomepagebannerController extends Controller
{
    use DatatablTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['title'] = 'Banner';
        return view('admin.banner.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['title'] = 'Add Banner' ;
        return view('admin.banner.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // dd($this->uploadImage($request));
        $slider = new Homepagebanner();
        $slider->slider_img = $this->uploadImage($request);
        $slider->added_by = Auth::user()->id;
        $slider->save();

        return redirect()->route('admin.homepagebanners.index')->with('success' , "Banner created successfully.");

    }
    

    public function dataListing(Request $request)
    {

        // Listing colomns to show
        $columns = array(
            0 => 'id',
            1 => 'slider_img',
            2 => 'is_active',
            3 => 'action',
        );


        $totalData = Homepagebanner::count(); // datata table count

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        // dd($request);

        // DB::enableQueryLog();
        // genrate a query
        $customcollections = Homepagebanner::when($search, function ($query, $search) {
            return $query->where('slider_img', 'LIKE', "%{$search}%");
        });

        // dd($totalData);

        $totalFiltered = $customcollections->count();

        $customcollections = $customcollections->offset($start)->limit($limit)->orderBy($order, $dir)->get();

        $data = [];
        // dd($customcollections);
        foreach ($customcollections as $key => $item) {
            
            // dd($item);
            $row['id'] = $item->id;
           // dd($item->slider_img);
            $row['slider_img'] = $this->image($item->slider_img,'100px');

           // dump($createDate);

           // dd($userCreate);
            $row['is_active'] = $this->status($item->is_active, $item->id, route('change-status', ['id' => $item->id]), 'homepagebanners');;
          

            $row['action'] = $this->action([
                collect([
                    'text'=> __('common.action.edit'),
                    'id' => $item->id,
                    'action' => route('admin.homepagebanners.edit', $item->id),
                    'icon' => 'fa fa-edit',
                    'permission' =>  true
                ]),
                collect([
                    'text'=> __('common.action.delete'),
                    'id' => $item->id,
                    'action' => route('admin.homepagebanners.destroy', $item->id),
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->data['title'] = 'Edit Banner';
        $this->data['banner'] = Homepagebanner::findOrFail($id);
        return view('admin.banner.edit', $this->data);

    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $slider = Homepagebanner::findOrFail($id);
        $slider->slider_img = $this->uploadImage($request,$slider->slider_img);
        return redirect()->route('admin.homepagebanners.index')->with('success', "Banner updated successfully.");

    }
    public function uploadImage($request , $unlink = null)
    {
        //dd($request->all());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . rand(0, 500) . '_' . $file->getClientOriginalName();
           // dd($fileName);
            $fileName = str_replace(' ', '_', $fileName);
            $path = $file->storeAs('banner' , $fileName);
           // dd($path);
            if($unlink) {
                Storage::delete($unlink);
            }
           // dd($path);
            return $path;
        }
        return  $unlink ? $unlink : NULL;
    }
   

    public function destroy($id)
    {
        $statuscode = 400 ;

        $slider = Homepagebanner::findOrFail($id);

        \Storage::delete('public/banner/' . $slider->slider_img);
        
        if($slider->delete()) {
            $statuscode = 200 ;
        }

        return response()->json([
            'success' => true ,
            'message' => 'Banner deleted successfully.'
        ],$statuscode);

    }

    public function changeStatus(Request $request) {
        
        $statuscode = 400 ;
        $slider = Homepagebanner::findOrFail($request->id);
        $slider->is_active  = $request->status == 'true' ? 'Yes' : 'No' ;
        
        if($slider->save()) {
            $statuscode = 200 ;
        }
        $status = $request->status == 'true' ? 'activate' : 'deactivate' ;
        $message = 'Banner '.$status.' successfully.' ;

        return response()->json([
            'success' => true ,
            'message' => $message
        ],$statuscode);

    }

}
